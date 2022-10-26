<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use App\Post;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::orderBy('name', 'asc')->get();
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
        $params = $request->validate([
            'title' => 'required|max:255|min:5',
            'content' => 'required',
            'category_id'=> 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|max:2048'
        ]);

        $params['slug'] = Str::slug($params['title']);


        if(array_key_exists('image',$params)){
            $img_path =Storage::put('cover_path',$params['image']);
            $params['cover'] = $img_path;
        }

        $post = Post::create($params);
        
        if (array_key_exists('tags', $params)) {
            $post->tags()->sync($params['tags']);
        }
        
        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));	
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $params = $request->validate([
            'title' => 'required|max:255|min:5',
            'content' => 'required',
            'category_id'=> 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|max:2048'
        ]);

        $params['slug'] = Str::slug($params['title']);

        if (array_key_exists('image', $params)) {
            if ($post->cover) {
                Storage::delete($post->cover);
            }
            $img_path = Storage::put('cover_path', $params['image']);
            $params['cover'] = $img_path;
        }

        $post->update($params);

        if (array_key_exists('tags', $params)) {
            $post->tags()->sync($params['tags']);
        } else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $cover = $post->cover;
    
        $post->delete();
    

        if($post->cover && Storage::exists($post->cover)){
            Storage::delete($post->cover);
        }

        return redirect()->route('admin.posts.index');
    }
}
