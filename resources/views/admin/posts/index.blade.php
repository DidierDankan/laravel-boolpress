@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="mb-3">
            <h1>OUR POSTS</h1>
    
            <a class="btn btn-warning" href="{{ route('admin.posts.create') }}">Create Post</a>
        </div>

        <div class="deleted">
            @if(session('deleted')) 
                <div class="alert alert-success">
                    <strong> {{ session('deleted') }} </strong>
                </div>
            @endif
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Category
                    </th>
                    <th>
                        Posted at
                    </th>
                    <th colspan = "3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            {{ $post->id }}
                        </td>
                        <td>
                            {{ $post->title }}
                        </td>
                        <td>
                            @if ($post->category)     
                                {{ $post->category->name }}
                            @endif
                        </td>
                        <td>
                           <p>
                            {{ $post->created_at->format('d/m/y') }}
                            </p>
                            {{ $post->created_at->diffForHumans() }}
                        </td>
                        <td>
                            <a class="btn btn-primary" href=" {{ route('admin.posts.show', $post->id) }} ">
                                Show
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-warning" href=" {{ route('admin.posts.edit', $post->id) }} ">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form class="deleted" action=" {{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
    
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-2">
            <h2>
                Posts By Category:
            </h2>
            @foreach ($categories as $category)
                <h4 class="mt-2">
                    {{ $category->name }}:
                </h4>
                @forelse ($category->posts as $post)
                    <ul>
                        <li>
                            <a href=" {{ route('admin.posts.show', $post->id) }} "> {{ $post->title }}</a>
                        </li>
                    </ul>
                    @empty
                       No post for this category. <a href="{{ route('admin.posts.create') }}"> Create a new post</a>     
                    @endforelse
                @endforeach
        </div>
    </div>
    
@endsection