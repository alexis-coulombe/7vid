<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    public function index($slug)
    {
        /** @var Category $category */
        $category = Category::where(['slug' => $slug])->first();

        if (!$category) {
            abort(404);
        }

        $videos = $category->videos()->whereHas('setting', static function ($query) {
            $query->where(['private' => 0]);
        })->orderBy('created_at', 'DESC')->limit(16)->get();

        return view('category.index')->with('category', $category)
            ->with('videos', $videos);
    }
}
