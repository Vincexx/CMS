<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
class PostsController extends Controller
{
    public function show(Post $post) {

        return view('blog.show')->with('post', $post);

    }

    public function category(Category $category) {

        $search = request()->query('search');

        return view('blog.category')
        ->with('category', $category)
        ->with('posts', $category->posts()->searched()->paginate(2))
        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('search', $search);

    }

    public function tag(Tag $tag){

        $search = request()->query('search');

        return view('blog.tag')
        ->with('tag', $tag)
        ->with('posts', $tag->posts()->searched()->paginate(2))
        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('search', $search);

    }
}
