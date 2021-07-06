<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        $categories = Category::all();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validation 
        $request->validate([
            'title' => 'required|max:150|unique:posts',
            'category_id' => 'nullable|exists:categories,id',
            'tags' =>'nullable|exists:tags,id',
           'content' => 'required',
           'cover' => 'nullable|mimes:jpg,bmp,png,jpeg,gif,svg'
        ]);
        //mimes:jpg,bmp,png,jpeg,gif,svg

        //get the info to create a room
        $data = $request->all();

        
        //salvataggio della cover nella tabella
        if(array_key_exists('cover', $data)) {
            //posts-covers è il nome della cartella creata dentro a storage
            $data['cover'] = Storage::put('posts-covers', $data['cover']);
        }
        
        $data['slug'] = Str::slug($data['title'], '-');

        //crea stanza
        $new_post = new Post();

        //fill the data/ in Model fa il $fillable
        $new_post->fill($data);

        //save in db
        $new_post->save();

        //aggiunge nuove records nella tabella pivot
        if(array_key_exists('tags', $data)) {
            $new_post->tags()->attach($data['tags']);
        }

        //redirezziona la info a show
        return redirect()->route('admin.posts.show', $new_post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);

        if(! $post) {
            abort(404);
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        if(! $post) {
            abort(404);
        }

        return view('admin.posts.edit', compact('post','categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => [
                'required',
                'max:150',
                Rule::unique('posts')->ignore($id)
            ],
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'cover' => 'nullable|mimes:jpg,bmp,png,jpeg,gif,svg',
        ]);

        $data = $request->all();

        $post = Post::find($id);

        if(array_key_exists('cover', $data)) {
            if($post->cover) {
                //questo per delete la img del post precedente, se non lo cambia ma la img continua qui storata(morta)
                Storage::delete($post->cover);
            }

            $data['cover'] = Storage::put('posts-covers', $data['cover']);
            //$data perche il request sono il datti passati
        }

        //gen Slug
        if($data['title'] != $post->title) {
            $data['slug'] = Str::slug($data['title'], '-');
        };


        $post->update($data);

        if(array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']); // aggiunge o rimuove quelle gia esitente
        }else {
            $post->tags()->detach(); //rimuove tutte le reccord
        }

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $post = Post::find($id);

        if($post->cover){
            Storage::delete($post->cover);
        }

        //deleted post
        $post->delete();

        //polizia orfana della tabela pivot
        $post->tags()->detach();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title . ' was deleted.');
    }
}
