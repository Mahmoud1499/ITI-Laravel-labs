<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;




class PostController extends Controller
{


    public function index()
    {
        $allPosts = Post::with('user')->paginate();

        return PostResource::collection($allPosts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest  $request)
    {

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
