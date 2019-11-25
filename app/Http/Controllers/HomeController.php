<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Video;
use App\VideoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $newVideos = Video::orderBy('created_at', 'DESC')->limit(16)->get();
        $randomChannels = User::inRandomOrder()->limit(4)->get();
        $popularCategories = Category::withCount('videos')->latest('videos_count')->take(3)->get();

        return view('home.home')->with('newVideos', $newVideos)
            ->with('randomChannels', $randomChannels)
            ->with('categories', $popularCategories);
    }

    public function privacy()
    {
        return view('home.privacy');
    }

    public function settings()
    {
        if (request()->isMethod('post')) {

            $this->validate(request(), [
                'name' => 'required|max:255|min:3',
                'email' => 'required|max:255|min:3',
            ]);

            /** @var User $user */
            $user = Auth::user();

            $user->name = request('name');
            $user->email = request('email');

            if (request('new-password')) {
                if (!Hash::check(request('password'), $user->getPassword()) || request('new-password') !== request('confirm-password')) {
                    return redirect()->back()->withErrors(['You\'r password does not match.']);
                } else {
                    $user->password = Hash::make(request('password'));
                }
            }
            return view('home.settings')->with('success', ['Settings saved.']);
        } else {
            return view('home.settings');
        }
    }

    public function scroll(Request $request)
    {
        if (request()->ajax()) {
            $exclude = request()->input('exclude') ?: [];
            $users = User::withCount('videos')->latest('videos_count')->take(3)->whereNotIn('id', $exclude)->get();

            foreach ($users as $user) {
                if (!count($user->videos) > 0) {
                    return 'Done';
                }
            }

            return view('shared.video.scroll.result')->with('channels', $users);
        }

        App::abort(405);
    }
}
