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
        // code to validate the data
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:5'],
        ], 
        [
            'title.required' => 'The title field is required :).',
            'description.required' => 'The description field is required :).',
        ]);

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
    public function edit(Post $post)
    {
        return view('posts.edit', ['users' => User::all(), 'post' => $post]);
    }
    public function update($postID)
    {
        // code to validate the data
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:5'],
        ], 
        [
           'title.required' => 'The title field is required :).',
           'description.required' => 'The description field is required :).',
        ]);


        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->user_id;

        // 2- update the user data in database
        // select or find the post  
        // update the post data

        $singlePostFromDB = Post::find($postID);
        $singlePostFromDB->update([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator
        ]);


        // redirection

        return redirect()->route('posts.index', $postID);
    }
}
