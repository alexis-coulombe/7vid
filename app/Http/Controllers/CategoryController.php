<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * See category page
     *
     * @param $slug
     * @return View
     */
    public function index($slug): View
    {
        /** @var Category $category */
        $category = Category::where(['slug' => $slug])->first();

        if ($category === null) {
            abort(404);
        }

        $videos = $category->videos()->whereHas('setting', static function ($query) {
            $query->where(['private' => 0]);
        })->orderBy('created_at', 'DESC')->limit(16)->get();

        return view('category.index')->with('category', $category)
            ->with('videos', $videos);
    }
}
