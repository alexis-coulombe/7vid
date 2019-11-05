<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Video;
use Illuminate\Http\Request;

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
}
