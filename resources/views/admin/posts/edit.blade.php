@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3">
            <span>
                <a href=" {{ route('admin.posts.index') }} "><-- Go back to Post</a>
            </span>
            <h2>Edit Post</h2>
        </div>
        <form class="form-" action=" {{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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
                <textarea class="form-control" name="content" id="content">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    {{$message}}
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id">Category</label>
                <select class="form-control @error('category_id') is-invalid @enderror" 
                name="category_id" 
                id="category_id">
                   <option value="">-- Select Category --</option> 
                   @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @if($category->id == old('category_id',$post->category_id))selected @endif>
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
                        @if($errors->any() && in_array($tag->id, old('tags', [])))
                            checked
                        @elseif(! $errors->any() && $post->tags->contains($tag->id))
                            checked
                        @endif>
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
                <div>
                    <label for="cover" class="form-label">Post cover:</label>
                </div>
                @if ($post->cover)      
                    <img width="200" class="mb-2" src=" {{ asset('storage/' . $post->cover) }} " alt=" {{ $post->title }} ">
                @endif

                <input type="file" class="form-control @error('cover') is-invalid @enderror" 
                name="cover" 
                id="cover" >
                @error('cover')
                    <div class="feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <button class="btn btn-warning">Update Post</button>
        </form>
    </div>  
@endsection