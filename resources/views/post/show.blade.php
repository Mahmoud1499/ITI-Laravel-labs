@extends('layouts.layout1')

@section('title')
    Show
@endsection

@section('content')
    <div class="card mt-3">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{ $post['title'] }}</h5>
            <p class="card-text">Description: {{ $post['description'] }}</p>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            @if ($user['name'])
                <h5 class="card-title">Posted By: {{ $user['name'] }}</h5>
            @else
                <h5 class="card-title">Not Found</h5>
            @endif

            <p class="card-text">Created At: {{ \Carbon\Carbon::parse($post['created_at'])->isoformat('dddd d-m-Y') }}</p>
            <p class="card-text">Updated At: {{ \Carbon\Carbon::parse($post['updated_at'])->format('D d-m-Y') }}</p>

            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

            {{-- <?php dd($post); ?> --}}
            {{-- <?php dd($user); ?> --}}

        </div>
    </div>


    {{-- //Comment --}}
    <div class="card mt-3">
        <div class="card-header">
            Comments
        </div>
        <div class="card-body">
            <div class="comment">
                @foreach ($comments as $comment)
                    <div class="comments">
                        <p class="card-text">{{ $comment['comment'] }}</p>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
@endsection
