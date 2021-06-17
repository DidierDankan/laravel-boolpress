@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3">
            <h2>Edit Post</h2>
            <a href=" {{ route('admin.posts.index') }} "><-- Go back to Post</a>
        </div>
        <form class="form-" action=" {{ route('admin.posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $post->title) }}">
                @error('title')
                    {{$message}}
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea class="form-control" name="content" id="content">{{ old('content', $post->content) }}"</textarea>
                @error('content')
                    {{$message}}
                @enderror
            </div>

            <button class="btn btn-warning">Update Post</button>
        </form>
    </div>  
@endsection