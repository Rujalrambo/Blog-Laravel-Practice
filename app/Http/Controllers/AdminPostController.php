<?php

namespace App\Http\Controllers;

use id;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index',[
            'posts' => Post::paginate(50)
        ]);
    }

    public function create( )
    {
        return view('admin.posts.create');
    }


    public function store()
    {
        $post = new Post();
        
        $attributes = $this->validatePost();
        
        $attributes['user_id'] = Auth::id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit',['post' => $post] );
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);

        // if(request()->hasFile('thumbnail')){
        if(isset($attributes['thumbnail'])){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success','Post updated!');
    }

    public function destory(Post $post)
    {
        $post->delete();

        return back()->with('success','Post deleted!');
    }


    public function validatePost(Post $post = null):array
        {

        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? 'image' : 'required|image',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required',Rule::exists('categories', 'id')],
            'published_at' => 'required',
        ]);
    }
}
