@extends('layout')

@section('title', 'All Posts')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>All Posts</h1>
   <div>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Add New Post</a>

    <a href="{{ route('users.index') }}" class="btn btn-success">Show users</a>
   </div>
</div>

<table class="table table-striped table-bordered table-dark">
    <thead>
        <tr>
            <th scope="col">NO</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Images</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ Str::limit($post->description, 50) }}</td>
            <td>
                @if($post->images->isEmpty())
                    No Images
                @else
                    @foreach($post->images as $image)
                        <img src="{{ asset('storage/' . $image->path) }}" width="50" height="50" class="mr-2">
                    @endforeach
                @endif
            </td>
            <td>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success btn-sm">View</a>
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
