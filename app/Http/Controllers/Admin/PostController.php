<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['category', 'tags'])->orderBy('id', 'desc')->paginate(10);
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id');
        $tags = Tag::pluck('title', 'id');
        
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'thumbnail' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        
        $data['thumbnail']=Post::uploadImage($request);

        $post = Post::create($data);
        
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('posts.index')->with('success', 'Статья успешно создана');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('title', 'id');
        $tags = Tag::pluck('title', 'id');
        $selectedTags = $post->tags->pluck('id')->toArray();
        
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'thumbnail' => 'nullable|image|max:2048'
        ]);

        $post=Post::find($id);
        $data=$request->all();
        $data['thumbnail']= Post::uploadImage($request,$post->thumbnail);

        $post->updated($data);
        $post->tags()->sync($request->tags);

        return redirect()->route('posts.index')->with('success', 'Статья успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->tags()->sync([]);
        Storage::delete($post->thumbnail);
        $post->delete();
        
        return redirect()->route('posts.index')->with('success', 'Статья успешно удалена');
    }
}