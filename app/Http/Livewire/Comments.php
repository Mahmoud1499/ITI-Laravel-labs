<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Comments extends Component
{

    public $post;
    public $comments;
    protected $listeners = ["commentAdded" => '$refresh'];
    public function deleteComment($id)
    {

        $comment = $this->post->comments()->find($id);
        // dd($comment);
        $comment->delete();

        $this->emit("commentAdded");
    }

    public function render()
    {
        // dd($this->post);
        $this->comments = $this->post->comments;
        return view('livewire.comments', ["comments" => $this->comments]);
    }
}
