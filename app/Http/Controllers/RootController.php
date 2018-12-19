<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RootController extends Controller
{
    public function index(Request $request){
        $videos = null;
        $categories = DB::table('categories')->get();

        if($request->input('search') != null){
            if($request->input('category') != null){
                $videos = Video::where(['title', 'LIKE', '%' . $request->input('search') . '%'], ['category_id', '=', $request->input('category')])->get();
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
