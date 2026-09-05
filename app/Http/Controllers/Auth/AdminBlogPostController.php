<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminBlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPost::latest()->paginate(10);
        return view('admin.blog-posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog-posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = new BlogPost();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->excerpt = $request->excerpt;
        $post->content = $request->content;
        $post->category = $request->category;
        $post->user_id = Auth::id();
        $post->featured = $request->has('featured');
        $post->published_at = $request->has('published') ? now() : null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/blog'), $filename);
            $post->image = 'images/blog/' . $filename;
        }

        $post->save();

        return redirect('/admin/blog-posts')->with('success', 'Blog yazısı başarıyla oluşturuldu.');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        return view('admin.blog-posts.edit', compact('blogPost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $blogPost->title = $request->title;
        $blogPost->slug = Str::slug($request->title);
        $blogPost->excerpt = $request->excerpt;
        $blogPost->content = $request->content;
        $blogPost->category = $request->category;
        $blogPost->featured = $request->has('featured');
        $blogPost->published_at = $request->has('published') ? now() : null;

        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($blogPost->image && file_exists(public_path($blogPost->image))) {
                unlink(public_path($blogPost->image));
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/blog'), $filename);
            $blogPost->image = 'images/blog/' . $filename;
        }

        $blogPost->save();

        return redirect('/admin/blog-posts')->with('success', 'Blog yazısı başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        if ($blogPost->image && file_exists(public_path($blogPost->image))) {
            unlink(public_path($blogPost->image));
        }
        
        $blogPost->delete();
        return redirect('/admin/blog-posts')->with('success', 'Blog yazısı başarıyla silindi.');
    }
}
