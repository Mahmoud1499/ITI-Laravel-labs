<div>

    <h2>Add Comment</h2>

    <div class="form-group">
        @csrf
        <label for="comment">Comment</label>
        <textarea name="comment" id="comment" class="form-control" required wire:model="comment"></textarea>
        <button type="button" wire:click="addComment" class="btn btn-primary">add comment</button>
    </div>

</div>
