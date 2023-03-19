<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPosts extends Component
{
    public $user;
    public $foundPost;


    public function render()
    {

        return view('livewire.show-posts');
    }
    public function popUP($id)
    {


        // dd("hello");
        // $this->dispatchBrowserEvent('show-form');

        $foundPost = Post::find($id);

        $user = Post::find($foundPost['user_id'])->user;

        return view('livewire.show-posts', ['post' => $foundPost, 'user' => $user]);
    }


    /**
     */
}
