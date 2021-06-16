@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>{{ $post->title }}</h2>
        <div class="mb-5">
            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}"> Edit Post</a>
        </div>

        <p>
            {{ $post->content }}
        </p>

    </div>
    
@endsection