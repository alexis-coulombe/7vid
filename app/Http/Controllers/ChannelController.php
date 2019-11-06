<?php

namespace App\Http\Controllers;

use App\User;
use App\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ChannelController extends Controller
{

    public function index($userId)
    {
        $author = User::find($userId);

        if ($author == null) {
            abort(404);
        }

        return view('channel.index')->with('author', $author);
    }

    /**
     * Subscribe to another user
     *
     * @return RedirectResponse
     */
    public function subscribe()
    {
        $channelId = Input::post('channel_id');

        if (!isset($channelId) || $channelId <= 0 || !is_numeric($channelId)) {
            return back()->with('error', 'There was an error! Please try again later.');
        }

        /** @var User $channel */
        $channel = User::find($channelId);

        if (!Auth::user()->isSubscribed($channelId)) {
            Auth::user()->subscribe($channelId);
            $text = 'You have successfuly subscribed to <b>' . $channel->name . '</b>';
        } else {
            Auth::user()->unsubscribe($channelId);
            $text = 'You have successfuly unsubscribed from <b>' . $channel->name . '</b>';
        }

        return back()->with('success', $text);
    }

}
