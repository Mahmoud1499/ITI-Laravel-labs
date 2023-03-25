<div class="card mt-3">
    <div class="card-header">
        Comments
    </div>
    <div class="card-body  ">
        @foreach ($post->comments as $comment)
            <div class="d-flex ">
                <p>{{ $comment->comment }}</p>
                {{-- <p>Comment by {{ $post->user->name }}</p> --}}
                @method('delete')
                <button class="btn btn-danger mx-5" wire:click="deleteComment( {{ $comment['id'] }})"
                    onclick="return confirm('Are you sure?')">Delete</button>
                <hr>
            </div>
        @endforeach

    </div>
</div>
