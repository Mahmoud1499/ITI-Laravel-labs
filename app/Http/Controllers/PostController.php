<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PostController extends Controller
{
    // Dumy data
    // all posts
    public $allPosts = [
        [
            'id' => 1,
            'title' => 'Laravel',
            'posted_by' => 'Ahmed',
            'created_at' => '2022-08-01 10:00:00',
            'description' => 'hello description 1',
        ],

        [
            'id' => 2,
            'title' => 'PHP',
            'posted_by' => 'Mohamed',
            'created_at' => '2022-08-01 10:00:00',
            'description' => 'hello description 2',
        ],

        [
            'id' => 3,
            'title' => 'Javascript',
            'posted_by' => 'Ali',
            'created_at' => '2022-08-01 10:00:00',
            'description' => 'hello description 3',
        ],
    ];

    public function index()
    {


        //return view
        return view('post.index', ['posts' => $this->allPosts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        //get one post
        foreach ($this->allPosts as $post) {
            if ($post['id'] == $id) {
                $foundPost = $post;
            }
        }

        //        dd($post);

        return view('post.show', ['post' => $foundPost]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get one post
        foreach ($this->allPosts as $post) {
            if ($post['id'] == $id) {
                $foundPost = $post;
            }
        }
        return view('post.edit', ['post' => $foundPost]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // foreach ($this->allPosts as $post) {
        //     if ($post['id'] == $id) {
        //         $foundPost = $post;
        //     }
        // }
        // $index = $foundPost['id'] - 1;
        // array_splice($allPosts, $index, 1);
        return view('post.index');
    }
}
