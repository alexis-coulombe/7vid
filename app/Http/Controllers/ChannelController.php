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
use Illuminate\Support\Facades\Input;
use Illuminate\View\View;

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

        if ($author == null) {
            abort(404);
        }

        return view('channel.index')->with('author', $author);
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

            foreach($users as $user){
                if(!count($user->videos) > 0){
                    return 'Done';
                }
            }

            return view('shared.video.scroll.result')->with('channels', $users);
        } else {
            return response(405);
        }
    }

    /**
     * Subscribe to another user
     *
     * @return RedirectResponse
     */
    public function subscribe()
    {
        if (request()->ajax() && Auth::check()) {
            $id = request()->input('id');

            if (!isset($id) || $id <= 0 || !is_numeric($id)) {
                return response(405);
            }

            /** @var User $channel */
            $channel = User::find($id);

            if($channel) {
                if (!Auth::user()->isSubscribed($channel->id)) {
                    Auth::user()->subscribe($channel->id);
                    $text = 'Unsubscribe';
                } else {
                    Auth::user()->unsubscribe($channel->id);
                    $text = 'Subscribe';
                }

                return $text;
            } else {
                return response(400);
            }
        } else {
            return response(405);
        }
    }

}
