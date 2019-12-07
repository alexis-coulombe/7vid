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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $videos = $user->videos;
        $subscribers = $user->subscribers();
        $totalViews = 0;


        /** @var Video $video */
        foreach ($videos as $video) {
            $totalViews += $video->getViewsCount();
        }

        return view('dashboard.index')->with('totalViews', $totalViews)
            ->with('videos', $videos)->with('subscribers', $subscribers)
            ->with('user', $user);
    }
}
