@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="mb-3">
            <h2>{{ $post->title }}</h2>
            <a href=" {{ route('admin.posts.index') }} "><-- Go back to Post</a>
        </div>

        @if ($post->category)
            <h3>Category: {{ $post->category->name }} </h3>    
            
        @endif
        <div class="mb-5">
            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}"> Edit Post</a>
        </div>

        <p>
            {{ $post->content }}
        </p>

    </div>
    
@endsection