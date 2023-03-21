@extends('layouts.app')

@section('title')
    Show
@endsection

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            {{-- <img src="/storage/1679320443.jpg" alt=" Post img"> --}}

            <img src="/storage/{{ $post->img_name }}" alt=" Post img">
            <h5 class="card-title">Title: {{ $post['title'] }}</h5>
            <p class="card-text">Description: {{ $post['description'] }}</p>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            {{-- @if ($user['name'])
                <h5 class="card-title">Posted By: {{ $user['name'] }}</h5>
            @else
                <h5 class="card-title">Not Found</h5>
            @endif --}}
            <h5 class="card-title">Posted By: {{ $post['user_id'] }}</h5>
            {{-- <h5 class="card-title">Posted By: {{ $user['user_id'] }}</h5> --}}


            <p class="card-text">Created At: {{ \Carbon\Carbon::parse($post['created_at'])->isoformat('dddd d-m-Y') }}</p>
            <p class="card-text">Updated At: {{ \Carbon\Carbon::parse($post['updated_at'])->format('D d-m-Y') }}</p>

            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

            {{-- <?php dd($post); ?> --}}
            {{-- <?php dd($user); ?> --}}

        </div>
    </div>


    {{-- //Comment --}}
    <h2>Add Comment</h2>
    <form method="POST" action="{{ route('comments.store') }}">
        @csrf
        <div class="form-group">
            <label for="body">Comment</label>
            <textarea name="body" id="body" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            {{-- <label for="user">User</label> --}}
            {{-- <select name="user" id="user" class="form-control" required>

                <option value="{{ $post->user->id }}">{{ $post->user->name }}</option>

            </select> --}}
        </div>
        <input type="hidden" name="commentable_id" value="{{ $post->id }}">
        <input type="hidden" name="commentable_type" value="{{ get_class($post) }}">
        <button type="submit" class="btn btn-primary m-2">Submit</button>
    </form>




    <div class="card mt-3">
        <div class="card-header">
            Comments
        </div>
        <div class="card-body  ">
            @foreach ($post->comments as $comment)
                <div class="d-flex ">
                    <p>{{ $comment->comment }}</p>
                    {{-- <p>Comment by {{ $post->user->name }}</p> --}}
                    <form action=" {{ route('comments.destroy', $comment['id']) }}" method="POST" class=" d-inline mx-5">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        {{-- <x-button route=" {{ route('posts.destroy', $post['id']) }}" type="danger" content="Delete" /> --}}
                    </form>
                    <hr>
                </div>
            @endforeach

        </div>
    </div>
@endsection
