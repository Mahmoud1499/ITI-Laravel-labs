@extends('layouts.layout1')

@section('title')
    Edit
@endsection
{{-- {{ var_dump($post) }} --}}
@section('content')
    @csrf
    <form class="mt-3" action="{{ route('posts.update', $post['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="postId" class="form-label">Post ID</label>
            <input type="text" class="form-control" id="postId" aria-describedby="emailHelp" name="postId"
                value="{{ $post['id'] }} " disabled>
        </div>
        <div class="mb-3">
            <label for="postTitle" class="form-label">post Title</label>
            <input type="text" class="form-control" id="postTitle" name="postTitle" value="{{ $post['title'] }}">
        </div>
        <div class="mb-3">
            <select name="postPostedBy" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="postCreatedAt" class="form-label">post Created At</label>
            <input type="text" class="form-control" id="postCreatedAt" name="postCreatedAt"
                value="{{ $post['created_at'] }}" disabled>
        </div>
        <div class="mb-3">
            <label for="postDescription" class="form-label">post Description</label>
            <input type="text" class="form-control" id="postDescription" name="postDescription"
                value="{{ $post['description'] }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
