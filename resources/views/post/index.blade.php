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
    {{-- @if (!request()->has('view_deleted'))
        <a href="{{ route('posts.index', ['view_deleted' => 'DeletedRecords']) }}" class="btn btn-primary">View Delete
            Records</a>
    @endif --}}
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
                        @if (!$post->trashed())
                            <x-button route="{{ route('posts.show', $post['id']) }}" type="info" content="View" />
                            <x-button route="{{ route('posts.edit', $post['id']) }}" type="primary" content="Edit" />

                            <form action="{{ route('posts.view', $post->id) }}" method="GET">
                                @csrf
                                @method('GET')
                                <button class="btn btn-warning view-post" data-id="{{ $post->id }}"> Ajax</button>
                            </form>
                        @endif


                        @if ($post->trashed())
                            <form action=" {{ route('posts.restore', $post['id']) }}" method="POST" class="d-inline">
                                @csrf

                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Restore</button>
                                {{-- <x-button route=" {{ route('posts.destroy', $post['id']) }}" type="danger" content="Delete" /> --}}
                            </form>
                        @else
                            <form action=" {{ route('posts.destroy', $post['id']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>

                            </form>
                        @endif
                    </td>

                </tr>
            @endforeach
            {{-- @livewire('show-posts') --}}
            </div>
        </tbody>
        {{-- <?php dd($user); ?> --}}
    </table>


    <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Post Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Title : <span id="postTitle"></span></h4>
                    <h4>Slug : <span id="slug"></span></h4>

                    <h4>Description : <span id="postDescription"></span></h4>
                    <h4>Username : <span id="postUsername"></span></h4>
                    <h4>User Email : <span id="postUseremail"></span></h4>
                    <h4 class="card-text">Created At : <span id="createdAt"></span> </h4>
                    <h4 class="card-text">Updated At : <span id="UpdatedAt"></span></h4>
                </div>

            </div>
        </div>
    </div>
    <div class="d-flex">
        {{ $posts->links('pagination::simple-bootstrap-5') }}
    </div>
    {{-- @dd($post) --}}

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- // ajax --}}
    <script>
        $(document).ready(function() {
            $('.view-post').click(function() {

                event.preventDefault();
                var postId = $(this).data('id');

                $.ajax({
                    url: '/posts/' + postId + '/view',
                    type: 'GET',
                    success: function(response) {
                        $('#postTitle').text(response.title);
                        $('#postDescription').text(response.description);
                        $('#postUsername').text(response.username);
                        $('#postUseremail').text(response.useremail);
                        $('#createdAt').text(response.createdAt);
                        $('#UpdatedAt').text(response.updatedAt);
                        $('#slug').text(response.slug);

                        $('#postModal').modal('show');
                    }
                });
            });
        });
    </script>
@endsection
