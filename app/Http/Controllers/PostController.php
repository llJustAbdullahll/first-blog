<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }
    public function show($post)
    {
        // $post = Post::find($post);
        $post = Post::where('title', 'PHP')->get();
        dd($post);
        return view('posts.show', ['post' => $post]);
    }
}
