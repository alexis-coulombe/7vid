<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request = null)
    {
        $newVideos = Video::orderBy('created_at', 'DESC')->limit(16)->get();
        $newChannels = User::inRandomOrder()->limit(4)->get();

        return view('home.home')->with('newVideos', $newVideos)->with('newChannels', $newChannels);
    }

    public function privacy(){
        return view('home.privacy');
    }
}
