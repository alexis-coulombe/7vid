<?php

namespace App\Http\Controllers;

use App\Category;
use App\Video;
use Illuminate\Http\Request;

class RootController extends Controller
{
    public function index(Request $request){
        $videos = null;
        $categories = Category::all();

        if($request->input('search') != null){
            if($request->input('category') != null){
                $videos = Video::where('title', 'LIKE', '%' . $request->input('search') . '%')->where('category_id', '=', $request->input('category'))->get();
            }else {
                $videos = Video::where('title', 'LIKE', '%' . $request->input('search') . '%')->get();
            }
        }else {
            if($request->input('category') != null){
                $videos = Video::where('category_id', '=', $request->input('category'))->get();
            }else {
                $videos = Video::all();
            }
        }

        return view('root.home')->with('videos', $videos)->with('categories', $categories);
    }

    public function term(){
        return view('root.term');
    }
}
