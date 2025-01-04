@extends('layout')

@section('title', 'Edit Post')

@section('content')
<h1>Edit Post</h1>
<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4" required>{{ $post->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="images" class="form-label">Images</label>
        <input type="file" class="form-control" id="images" name="images[]" multiple>

        @foreach($images as $image)
            <img src="{{ asset('storage/' . $image) }}" width="100" height="100" class="mt-2">
        @endforeach
    </div>
    <button type="submit" class="btn btn-success">Update Post</button>
</form>
@endsection
