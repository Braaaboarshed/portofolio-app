@extends('layout')

@section('title', 'Post Details')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{{ $post->description }}</p>

@if($post->images->isEmpty())
    <p>No Images Available</p>
@else
    <div class="row">
        @foreach($post->images as $image)
            <div class="col-4 mb-3">
                <img src="{{ asset('storage/' . $image->path) }}" width="300" height="300" class="img-fluid">
            </div>
        @endforeach
    </div>
@endif

<a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back to All Posts</a>
@endsection
