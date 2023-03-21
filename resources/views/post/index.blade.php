@extends('layouts.app')
@section('title')
    Index
@endsection

@section('content')
    <div class="text-center">
        <a href="{{ route('posts.create') }}">
            <button type="button" class="mt-4 btn btn-success">Create Post</button>
        </a>
    </div>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Slug</th>
                <th scope="col">Image Name</th>

                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($posts as $post)
                <tr>
                    {{-- @dd($post->slug) --}}

                    <td>{{ $post['id'] }}</td>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post->user->name }}</td>
                    {{-- <td>{{ $user['name'] }}</td> --}}

                    {{-- <td>{{ $post['created_at'] }}</td> --}}
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->img_name }}</td>


                    <td>{{ \Carbon\Carbon::parse($post['created_at'])->format('d-m-Y') }}
                    </td>
                    <td class="d-flex justify-content-around">
                        {{-- <?php dd($post); ?> --}}
                        {{-- <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-info">View</a> --}}
                        {{-- <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-primary">Edit</a> --}}
                        {{-- <a href="{{ route('posts.destroy', $post['id']) }}" class="btn btn-danger">Delete</a> --}}

                        <x-button route="{{ route('posts.show', $post['id']) }}" type="info" content="View" />
                        <x-button route="{{ route('posts.edit', $post['id']) }}" type="primary" content="Edit" />

                        {{-- @if (!$post->trashed()) --}}
                        <form action=" {{ route('posts.destroy', $post['id']) }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            {{-- <x-button route=" {{ route('posts.destroy', $post['id']) }}" type="danger" content="Delete" /> --}}
                        </form>
                        {{-- @else
                            <form action=" {{ route('posts.restore', $post['id']) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Restore</button>

                            </form>
                        @endif --}}

                        <button type="button" wire:click="popUP(9)" type="button" class="btn btn-primary d-inline"
                            data-toggle="modal" data-target=".bd-example-modal-lg">Ajax</button>
                </tr>
            @endforeach
            @livewire('show-posts')

            </div>

        </tbody>
        {{-- <?php dd($user); ?> --}}
    </table>
    <div class="d-flex">
        {{ $posts->links('pagination::simple-bootstrap-5') }}
    @endsection
