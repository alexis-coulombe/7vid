<?php

namespace App\Http\Controllers;

use App\User;
use App\Video;
use App\Views;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * Show history of connected user
     * @param $userId
     * @return Factory|View
     */
    public function history($userId)
    {
        if(intval($userId) !== Auth::user()->id) {
            return redirect(route('channel.history', ['userId' => Auth::user()->id]));
        }

        $videos_id = Views::where('author_id', '=', $userId)->select('id')->limit(50)->orderBy('updated_at', 'DESC')->get();
        $videos = [];

        if(count($videos_id) > 0) {
            $videos = Video::whereIn('id', $videos_id)->get();
        }

        return view('channel.history')->with('videos', $videos);
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
        }

        App::abort(405);
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
