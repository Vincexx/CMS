<?php

namespace App\Http\Controllers;
use App\Category;
use App\Tag;
use App\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {

        $search = request()->query('search');



        return view('welcome')->with('categories', Category::all())
                              ->with('tags', Tag::all())
                              ->with('posts', Post::searched()->paginate(2))
                              ->with('search', $search);    
    }
}
