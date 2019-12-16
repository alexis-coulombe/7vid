<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Country;
use App\Notifications\_Notification;
use App\User;
use App\Video;
use App\VideoSetting;
use App\Views;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        $newVideos = Video::orderBy('created_at', 'DESC')->limit(16)->get();
        $popularCategories = Category::withCount('videos')->latest('videos_count')->take(3)->get();

        if (Auth::check()) {
            $randomChannels = User::inRandomOrder()->where('id', '<>', Auth::user()->id)->limit(4)->get();
        } else {
            $randomChannels = User::inRandomOrder()->limit(4)->get();
        }
        return view('home.home')->with('newVideos', $newVideos)
            ->with('randomChannels', $randomChannels)
            ->with('categories', $popularCategories);
    }

    /**
     * Privacy page
     *
     * @return View
     */
    public function privacy(): View
    {
        return view('home.privacy');
    }

    /**
     * Account setting page
     *
     * @return View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function settings(): View
    {
        if (request()->isMethod('post')) {

            $this->validate(request(), [
                'email' => 'required|max:255|min:3',
                'country' => 'required|min:1',
                'current-password' => 'max:255',
                'password' => 'max:255',
                'confirm-password' => 'max:255',
            ]);

            /** @var User $user */
            $user = Auth::user();

            $user->email = request('email');

            $country = Country::find(request('country'));
            if ($country) {
                $user->country_id = request('country');
            } else {
                return redirect()->back()->withErrors(['There was an error, please try again.']);
            }

            if (request('password')) {
                if (!Hash::check(request('current-password'), $user->getPassword()) || request('password') !== request('confirm-password')) {
                    return view('home.settings')->with('error', 'Your password does not match.');
                }

                $user->password = Hash::make(request('password'));
            }

            $user->save();
            return view('home.settings')->with('success', 'Settings saved.');
        }

        return view('home.settings');
    }

    /**
     * Show liked video of current user
     *
     * @return View
     */
    public function liked(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $likedVideos = $user->videoVotes->where('value', 1);
        $videos = [];

        foreach ($likedVideos as $like) {
            $videos[] = $like->video;
        }

        return view('home.liked')->with('videos', $videos);
    }

    /**
     * Show video history of current user
     *
     * @return Factory|View
     */
    public function history(): View
    {
        $videos_id = Views::where('author_id', '=', Auth::user()->id)->select('video_id')->limit(50)->get();
        $videos = [];

        if (count($videos_id) > 0) {
            $videos = Video::whereIn('id', $videos_id)->orderBy('updated_at', 'DESC')->get();
        }

        return view('channel.history')->with('videos', $videos);
    }

    public function scroll(Request $request)
    {
        if (request()->ajax()) {
            $exclude = request('exclude') ?: [];

            if (request('type') === 'channel-video') {
                $users = User::withCount('videos')->latest('videos_count')->take(3)->whereNotIn('id', $exclude)->get();

                foreach ($users as $user) {
                    if ((!count($user->videos)) > 0) {
                        return 'Done';
                    }
                }

                return view('shared.video.scroll.channel-video')->with('channels', $users);
            }

            if (request('type') === 'category-video') {
                $categoryId = request('category_id');
                $category = Category::find($categoryId);

                if ($category) {
                    $videos = $category->videos()->orderBy('created_at', 'DESC')->take(16)->whereNotIn('id', $exclude)->get();

                    if ((!count($videos)) > 0) {
                        return 'Done';
                    }

                    return view('shared.video.scroll.category-video')->with('videos', $videos);
                }
            }

            if (request('type') === 'comment') {
                $videoId = request('video_id');
                $video = Video::find($videoId);

                if ($video) {
                    $comments = Comment::where(['video_id' => $videoId])->orderBy('created_at')->take(5)->whereNotIn('id', $exclude)->get();

                    if ((!count($comments)) > 0) {
                        return 'Done';
                    }

                    return view('comment.show')->with('comments', $comments);
                }
            } else {
                return 'Done';
            }
        }

        App::abort(405);
    }
}
