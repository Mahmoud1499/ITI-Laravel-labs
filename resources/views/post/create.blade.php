@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="mt-3" action="{{ route('posts.store') }} " method="POST" enctype="multipart/form-data">
        @csrf
        {{-- <div class="mb-3">
            <label for="postId" class="form-label">Post ID</label>
            <input type="text" class="form-control" id="postId" aria-describedby="emailHelp" name="postId"
                disabled='disabled'>
        </div> --}}
        <div class="mb-3">
            <label for="postTitle" class="form-label">post Title</label>
            <input type="text" class="form-control" id="postTitle" name="postTitle">
        </div>
        <div class="mb-3">
            <label for="postPostedBy" class="form-label">post Posted By</label>
            <select name="postPostedBy" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="avatar" class="form-label">post Img</label>
            <input type="file" class="form-control" id="avatar" name="postFile">
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <input type="test" class="form-control" name="tags" id="tags">
        </div>
        <div class="mb-3">
            <label for="postDescription" class="form-label">post Description</label>
            <textarea type="text" class="form-control" id="postDescription" name="postDescription"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
