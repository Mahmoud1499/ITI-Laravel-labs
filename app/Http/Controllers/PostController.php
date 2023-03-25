<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Rules\threePostsOnlyForOneUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;
use Illuminate\Http\File;



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

    public function index(Request $request)
    {
        $allPosts = Post::latest()->withTrashed()->paginate(10);
        $user = User::all();

        if ($request->has('view_deleted')) {
            // $allPosts = $allPosts->onlyTrashed();
        }



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
        // validate on the form data
        $request->validate([
            'postTitle' => ['required', 'min:3', 'unique:posts,title,except,id'],
            'postDescription' => ['required', 'min:5'],
            'postFile.*' =>  'mimes:jpeg,png,jpg,gif,svg',
            'postFile' =>  'required',
            'postPostedBy' => ['required', 'exists:users,id', new threePostsOnlyForOneUser()],



        ], [
            'title.required' => 'my custom message',
            'title.min' => 'minimum custom message',
            'postFile' =>  'Post Image is require',

        ]);

        $user = User::find($request->postPostedBy);
        // dd($users)
        if (!$user) {
            abort('403');
        }
        if ($request->postFile) {
            // dd($request->all());
            $image      = $request->file('postFile');
            $fileName   = time() . '.' . $image->extension();
            $image->storeAs('public/', $fileName);
        }

        // dd($request);
        //get data from request
        $title = request()->postTitle;
        $description = request()->postDescription;
        $postCreator = request()->postPostedBy;
        $slug = $title;
        $tags = explode(",", $request->tags);

        //insert data in db
        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
            'img_name' => $fileName,
            "tags" => $tags
        ]);
        $post->syncTags($tags);
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
        // $user = Post::find($foundPost['user_id'])->user;
        $user =   $comments = $foundPost->comments;
        Post::with('user')->findOrFail($id);
        // dd($post);
        return view('post.show', ['post' => $foundPost, 'user' =>  $user, "comments" => $comments]);
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

    public function view($id)
    {
        $post = Post::find($id);

        return response()->json([
            'title' => $post->title,
            'description' => $post->description,
            'createdAt' => $post->created_at,
            'updatedAt' => $post->updated_at,
            'slug' => $post->slug,
            'username' => $post->user->name,
            'useremail' => $post->user->email,
        ]);
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
        $post = Post::find($id);
        // dd($post->img_name);
        $post->delete();
        $image_path = public_path('storage/' . $post->img_name);
        if ($image_path) {
            //File::delete($image_path);
            unlink($image_path);
        }
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
