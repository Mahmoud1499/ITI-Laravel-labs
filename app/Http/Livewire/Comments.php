<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comments extends Component
{

    public $post;
    public $comments;
    protected $listeners = ["commentAdded" => '$refresh'];


    public function render()
    {

        $this->comments = $this->post->comments;
        return view('livewire.comments', ["comments" => $this->comments]);
    }
}
