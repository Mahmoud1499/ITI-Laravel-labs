<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddComments extends Component

{
    public $post;
    public $comments;
    public $comment;
    public function addComment()
    {

        $this->post->comments()->create([
            "comment" => $this->comment
        ]);

        $this->emit("commentAdded");
    }

    public function render()
    {
        return view('livewire.add-comments');
    }
}
