<div>
    <div class="card mt-3">
        <div class="card-header">
            add new comment
        </div>
        <div class="card-body">
            @csrf
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea class="form-control" name="comment" id="comment" wire:model="comment"></textarea>
            </div>
            <button type="button" wire:click="addComment" class="btn btn-primary">Update</button>
        </div>
    </div>
</div>
