<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    //getting posts from db
    public function index() {
        // $posts = Post::all();

        $posts = Post::paginate(2);

        return response()->json($posts);
        //se dichiaro dentro al Json $posts, senza compact, il res dentro a then della chiamata axios sara res.data.data
    }

    //getting details from posts
    public function show($slug) {

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();
        // questo with sono le tabelle relazionate dentro a model Post

        return response()->json($post);
    }
}
