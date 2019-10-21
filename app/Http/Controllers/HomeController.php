<?php

namespace App\Http\Controllers;

use App\Category;
use App\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request = null)
    {
        $newVideos = Video::orderBy('created_at', 'DESC')->take(16)->paginate(4);

        return view('home.home')->with('newVideos', $newVideos);
    }
}
