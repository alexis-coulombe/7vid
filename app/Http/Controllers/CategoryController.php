<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Video;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($name)
    {
        $category = Category::where('title', '=', $name)->first();

        if (!$category) {
            App::abort(404);
        }

        return view('category.index')->with('category', $category);
    }
}
