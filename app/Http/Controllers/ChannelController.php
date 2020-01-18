<?php

namespace App\Http\Controllers;

use App\ChannelSetting;
use App\User;
use App\Video;
use App\Views;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Stevebauman\Purify\Purify;
use Webpatser\Uuid\Uuid;

class ChannelController extends Controller
{

    /**
     * Channel index
     *
     * @param $userId
     * @return RedirectResponse
     */
    public function index($userId): RedirectResponse
    {
        return Redirect::route('channel.videos', ['userId' => $userId]);
        /*$author = User::find($userId);

        if ($author === null) {
            abort(404);
        }

        return view('channel.index')->with('author', $author);*/
    }

    /**
     * Channel videos
     *
     * @param int $userId
     * @return Factory|View
     */
    public function videos(int $userId)
    {
        $author = User::find($userId);

        if ($author === null) {
            abort(404);
        }

        return view('channel.videos')
            ->with('author', $author);
    }

    /**
     * Channel about
     *
     * @param int $userId
     * @return Factory|View|Response
     * @throws ValidationException
     */
    public function about(int $userId)
    {
        /** @var User $author */
        $author = User::find($userId);
        /** @var ChannelSetting $setting */
        $setting = $author->setting()->first();

        if ($author === null) {
            abort(404);
        }

        if ($setting === null) {
            $setting = new ChannelSetting();
            $setting->setChannelId($author->getId());
        }

        if (request()->isMethod('post')) {
            if (Auth::check() && Auth::user()->getId() === $userId) {
                $this->validate(
                    request(),
                    [
                        'about' => 'required|min:1',
                    ]
                );

                $about = strip_tags(request('about'));
                $setting->setAbout($about);

                $setting->save();
            } else {
                return response(401);
            }
        }

        return view('channel.about')->with('author', $author)
            ->with('setting', $setting);
    }

    /**
     * Infinite scroll for history page
     *
     * @return Factory|View|string
     */
    public function scroll()
    {
        if (request()->ajax()) {
            $exclude = request('exclude') ?: [];
            $users = User::withCount('videos')->latest('videos_count')->take(3)->whereNotIn('id', $exclude)->get();

            foreach ($users as $user) {
                if ((!count($user->videos)) > 0) {
                    return 'Done';
                }
            }

            return view('shared.video.scroll.result')->with('channels', $users);
        }

        return response(405);
    }

    /**
     * Subscribe to another user
     *
     * @return string
     */
    public function subscribe(): string
    {
        if (Auth::check() && request()->ajax()) {
            $id = request('id');

            if (!isset($id) || $id <= 0 || !is_numeric($id)) {
                return response(405);
            }

            /** @var User $channel */
            $channel = User::find($id);

            if ($channel) {
                if (!Auth::user()->isSubscribed($channel->getId())) {
                    Auth::user()->subscribe($channel->getId());
                    $text = 'Unsubscribe';
                } else {
                    Auth::user()->unsubscribe($channel->getId());
                    $text = 'Subscribe';
                }

                return $text;
            }

            return response(400);
        }

        return response(405);
    }

    /**
     * Search for video name
     *
     * @param int $userId
     * @return Factory|View
     */
    public function search(int $userId): View
    {
        /** @var User $user */
        $user = User::find($userId);
        /** @var string $search */
        $search = '%' . request('search') . '%';

        if (!$user) {
            abort(404);
        }

        /** @var array $videos */
        $videos = $user->videos()->whereHas('setting', static function ($query) {
            $query->where(['private' => 0]);
        })->where('title', 'LIKE', $search)->get();

        return View('channel.search')->with('videos', $videos)
            ->with('search', request('search'))->with('author', $user);
    }

    public function delete()
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = User::find(Auth::user()->getId());
            Auth::logout();

            if ($user) {
                try {
                    $user->delete();
                } catch (\Exception $e) {
                    abort(503);
                }
            }
        }

        return redirect()->back();
    }
}
