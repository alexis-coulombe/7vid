<?php

namespace App\Http\Controllers;

use App\User;
use App\Video;
use App\Views;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\View\View;
use Webpatser\Uuid\Uuid;

class ChannelController extends Controller
{

    /**
     * Channel index
     *
     * @param $userId
     * @return Factory|View
     */
    public function index($userId)
    {
        $author = User::find($userId);

        if ($author === null) {
            abort(404);
        }

        return view('channel.index')->with('author', $author);
    }

    /**
     * Channel videos
     *
     * @param $userId
     * @return Factory|View
     */
    public function videos($userId)
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
     * @param $userId
     * @return Factory|View
     */
    public function about($userId)
    {
        $author = User::find($userId);
        $setting = $author->setting;

        if ($author === null) {
            abort(404);
        }

        return view('channel.about')->with('author', $author)
            ->with('setting', $setting);
    }

    /**
     * Infinite scroll for history page
     *
     * @param Request $request
     * @return Factory|View|string
     */
    public function scroll(Request $request)
    {
        if (request()->ajax()) {
            $exclude = request()->input('exclude') ?: [];
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
        if (request()->ajax() && Auth::check()) {
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

    public function delete()
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = User::find(Auth::user()->getId());
            Auth::logout();

            if ($user) {
                $user->delete();
            }
        }

        return redirect()->back();
    }

}
