@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Creat a new Post</h2>
        <a href=" {{ route('admin.posts.index') }} "><-- Go back to Post</a>
        <form action=" {{ route('admin.posts.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" name="title" id="title" value=" {{ old('title') }} ">
                @error('title')
                    {{$message}}
                @enderror
            </div>
    
            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea class="form-control" name="content" id="content" value=" {{ old('content') }}"></textarea>
                @error('content')
                    {{$message}}
                @enderror
            </div>

            <button class="btn btn-primary">Create Post</button>
        </form>
    </div>    
@endsection