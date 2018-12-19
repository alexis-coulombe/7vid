<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RootController extends Controller
{
    public function index(){
        $videos = Video::all();
        $categories = DB::select('SELECT title FROM categories WHERE 1=1');
        return view('root.home')->with('videos', $videos)->with('categories', $categories);
    }

    public function term(){
        return view('root.term');
    }
}
