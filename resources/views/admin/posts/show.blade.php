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

        <div class="mb-3 row">
            @if ($post->cover)  
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('storage/' . $post->cover) }}" alt=" {{ $post->title }} ">
                </div>
            @endif
            <div class="{{($post->cover == null) ? 'col' : 'col-md-6'}}">
                {{ $post->content }}
            </div>
            
        </div>

        @if (count($post->tags) > 0)
            @foreach ($post->tags as $tag)
                <span class="badge badge-warning">
                    {{ $tag->name }}
                </span>
            @endforeach
        @endif

    </div>
    
@endsection