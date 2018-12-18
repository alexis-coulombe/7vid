<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class RootController extends Controller
{
    public function index(){
        $videos = Video::all();
        return view('root.home')->with('videos', $videos);
    }

    public function term(){
        return view('root.term');
    }
}
