<?php

namespace App\Http\Controllers;

use App\Category;
use App\ChannelSetting;
use App\Comment;
use App\Country;
use App\Notifications\_Notification;
use App\User;
use App\Video;
use App\VideoSetting;
use App\Views;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Stevebauman\Purify\Purify;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var ChannelSetting $setting */
        $setting = $user->setting;

        if (request()->isMethod('post')) {
            $setting = $user->setting;

            if (!isset($setting)) {
                $setting = new ChannelSetting();
                $setting->channel_id = $user->id;
            }

            if (request('about')) {
                $setting->about = (new Purify())->clean(request('about'));
            }
            $user->setting = $setting;
            $setting->save();
        }

        $videos = $user->videos;
        $subscribers = $user->subscribers();
        $totalViews = 0;


        /** @var Video $video */
        foreach ($videos as $video) {
            $totalViews += $video->getViewsCount();
        }

        return view('dashboard.index')->with('totalViews', $totalViews)
            ->with('videos', $videos)->with('subscribers', $subscribers)
            ->with('user', $user)->with('setting', $setting);
    }
}
