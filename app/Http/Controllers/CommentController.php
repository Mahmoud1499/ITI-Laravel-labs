<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $body = $request->body;
        //dd($title);
        $commentable_id = $request->commentable_id;
        $commentable_type = $request->commentable_type;

        //$post = Post::find($request->post);
        Comment::create([
            'comment' => $body,
            'commentable_type' => $commentable_type,
            'commentable_id' => $commentable_id,
        ]);
        return redirect()->back();
    }
    public function destroy(string $id)
    {

        $comment = Comment::find($id)->delete();


        return redirect()->back();
    }
}
