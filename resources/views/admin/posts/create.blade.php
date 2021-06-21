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
                value=" {{ old('content') }}"></textarea>
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

            <button class="btn btn-primary">Create Post</button>
        </form>
    </div>    
@endsection