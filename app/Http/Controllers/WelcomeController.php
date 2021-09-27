<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\POST;

class WelcomeController extends Controller
{
    public function index(Post $post)
    {
        return view('welcome')->with('posts', Post::all());
    }

    public function articles_show(Post $post)
    {
        return view('articles')->with('posts', Post::all());
    }
}
