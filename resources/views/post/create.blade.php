@extends('layouts.layout1')

@section('title')
    Create
@endsection

@section('content')
    <form class="mt-3" action="{{ route('posts.store') }} " method="POST">
        @csrf
        <div class="mb-3">
            <label for="postId" class="form-label">Post ID</label>
            <input type="text" class="form-control" id="postId" aria-describedby="emailHelp" name="postId">
        </div>
        <div class="mb-3">
            <label for="postTitle" class="form-label">post Title</label>
            <input type="text" class="form-control" id="postTitle" name="postTitle">
        </div>
        <div class="mb-3">
            <label for="postPostedBy" class="form-label">post Posted By</label>
            <input type="text" class="form-control" id="postPostedBy" name="postPostedBy">
        </div>
        <div class="mb-3">
            <label for="postCreatedAt" class="form-label">post Created At</label>
            <input type="text" class="form-control" id="postCreatedAt" name="postCreatedAt">
        </div>
        <div class="mb-3">
            <label for="postDescription" class="form-label">post Description</label>
            <input type="text" class="form-control" id="postDescription" name="postDescription">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
