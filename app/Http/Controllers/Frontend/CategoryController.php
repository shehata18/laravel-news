<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __invoke($slug)
    {
        $category = Category::whereSlug($slug)->first(); //same as => where('slug',$slug)
        $category_posts = $category->posts()->paginate(6);
        return view('frontend.category-posts', compact('category','category_posts'));
    }
}
