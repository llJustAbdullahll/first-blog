<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

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
        $post = Post::find($post);
        // $post = Post::where('ttile', 'Javascript')->first(); // this makes limit 1 and returns first result select * from posts where title = 'Javascript' limit 1;
        // $post = Post::where('ttile', 'Javascript')->get(); // this gets all results select * from posts where title = 'Javascript';
       
        return view('posts.show', ['post' => $post]);
    }
    public function create()
    {
        return view(
            'posts.create',
            ['users' => User::all()]
        );
    }
    public function store(Request $myRequestObject)
    {
        // 3 steps
        // get the request data
        // insert the request data into DB
        // redirection

        $data = $myRequestObject->all();
        // $data = request()->all;
        // request()->title == $data['title']

        Post::create($data);

        // Post::create($myRequestObject->all());

        // POST::Create([
        //     'title' => $data['title'],
        //     'description' => $data['description'],
        //     'id' => 1
        // ]);

        // with this syntax you don't need fillable
        // $post = new Post;
        // $post->title = $data['title'];
        // $post->description = $data['description'];
        // $post->save();


        return redirect()->route('posts.index');
    }
}
