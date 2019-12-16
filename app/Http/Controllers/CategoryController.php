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
        /** @var Category $category */
        $category = Category::where('title', '=', $name)->first();

        if (!$category) {
            App::abort(404);
        }

        $videos = $category->videos()->orderBy('created_at', 'DESC')->limit(16)->get();

        return view('category.index')->with('category', $category)
            ->with('videos', $videos);
    }
}
