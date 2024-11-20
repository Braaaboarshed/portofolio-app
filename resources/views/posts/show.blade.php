@extends('layout')

@section('title', 'Post Details')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{{ $post->description }}</p>
@if($post->image)
<img src="{{ asset('storage/' . $post->image) }}" width="300" height="300">
@endif
<a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back to All Posts</a>
@endsection
