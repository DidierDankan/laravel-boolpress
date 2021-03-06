@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Creat a new Post</h2>
        <a href=" {{ route('admin.posts.index') }} "><-- Go back to Post</a>
        <form action=" {{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                name="title" 
                id="title" 
                value=" {{ old('title') }} ">
                @error('title')
                    <div class="feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
    
            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                name="content" 
                id="content" 
                >{{ old('content') }}</textarea>
                @error('content')
                    <div class="feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id">Category</label>
                <select class="form-control @error('category_id') is-invalid @enderror" 
                name="category_id" 
                id="category_id">
                   <option value="">-- Select Category --</option> 
                   @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == old('category_id'))selected @endif>
                         {{ $category->name }} 
                        </option> 
                   @endforeach
                </select>
                @error('category_id')
                    <div class="feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                @foreach ($tags as $tag)
                    <span class="d-inline-block mr-4">
                        <input type="checkbox" 
                        name="tags[]" 
                        id="tag{{ $loop->iteration }}"
                        value="{{ $tag->id }}"
                        @if(in_array($tag->id, old('tags', []))) checked @endif>
                        <label for="tag{{ $loop->iteration }}">
                            {{ $tag->name }}
                        </label>
                    </span>
                @endforeach
                @error('tags')
                    <div class="feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cover" class="form-label">Post cover:</label>
                <input type="file" class="form-control @error('cover') is-invalid @enderror" 
                name="cover" 
                id="cover" 
                >
                @error('cover')
                    <div class="feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <button class="btn btn-primary">Create Post</button>
        </form>
    </div>    
@endsection