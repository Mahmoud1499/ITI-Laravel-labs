<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;


class PostController extends Controller
{
    // Dumy data all posts
    // public $allPosts = [
    //     [
    //         'id' => 1,
    //         'title' => 'Laravel',
    //         'posted_by' => 'Ahmed',
    //         'created_at' => '2022-08-01 10:00:00',
    //         'description' => 'hello description 1',
    //     ],

    //     [
    //         'id' => 2,
    //         'title' => 'PHP',
    //         'posted_by' => 'Mohamed',
    //         'created_at' => '2022-08-01 10:00:00',
    //         'description' => 'hello description 2',
    //     ],

    //     [
    //         'id' => 3,
    //         'title' => 'Javascript',
    //         'posted_by' => 'Ali',
    //         'created_at' => '2022-08-01 10:00:00',
    //         'description' => 'hello description 3',
    //     ],
    // ];

    public function index()
    {

        $allPosts = Post::paginate(10);
        $user = User::all();

        //return view
        return view('post.index', ['posts' => $allPosts], ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //get all users to show them in drop down menus
        $users = User::all();
        // $user = Post::find($users['user_id'])->user;

        return view('post.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        //get data from request
        $title = request()->postTitle;
        $description = request()->postDescription;
        $postCreator = request()->postPostedBy;
        //insert data in db
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator
        ]);
        // dd("store function");
        //redirect to index route
        return to_route('posts.index',);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get one post
        $foundPost = Post::find($id);
        // if ($foundPost['user_id'])
        $user = Post::find($foundPost['user_id'])->user;
        $comments = $foundPost->comments;

        // dd($post);
        return view('post.show', ['post' => $foundPost, 'user' => $user, "comments" => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //get users list
        $users = User::all();
        // get one post
        $foundPost = Post::find($id);


        return view('post.edit', ['post' => $foundPost, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //get data from resourse
        $title = request()->postTitle;
        $description = request()->postDescription;
        $postCreator = request()->postPostedBy;
        //insert data in db
        Post::where('id', $id)->update([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator
        ]);
        // dd("update function");
        //redirect to index
        return to_route('posts.index',);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //find and delete record
        // $post = Post::where('id', $id)->firstorfail()->update([
        //     'is_deleted' => '1'
        // ]);
        $post = Post::find($id)->delete();

        // foreach ($this->allPosts as $post) {
        //     if ($post['id'] == $id) {
        //         $foundPost = $post;
        //     }
        // }
        // $index = $foundPost['id'] - 1;
        // array_splice($allPosts, $index, 1);
        return to_route('posts.index',);
    }


    public function restore($id, Request $request)
    {
        $post = Post::withTrashed()->find($id);
        $post->restore();
        return to_route("posts.index");
    }
}
