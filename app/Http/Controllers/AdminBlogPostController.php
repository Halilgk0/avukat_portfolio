<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminBlogPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPost::paginate(10); // all() yerine paginate(10)
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
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'featured' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $slug = Str::slug($request->title);
        
        // Slug'ı benzersiz yap
        $count = 1;
        $originalSlug = $slug;
        while (BlogPost::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Dosya adını benzersiz bir isimle kaydedelim
            $imageName = $slug . '-' . time() . '.' . $request->image->extension();
            // İmajı public/images/blog dizinine yükleyelim
            $request->image->move(public_path('images/blog'), $imageName);
            $imagePath = 'images/blog/' . $imageName;
        }

        BlogPost::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => $slug,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'category' => $request->category,
            'image' => $imagePath,
            'featured' => $request->has('featured'),
            'published_at' => $request->filled('published') ? now() : null,
        ]);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog yazısı başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        return view('admin.blog-posts.show', compact('blogPost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        // Debug için blog post ID'sini yazdıralım
        \Log::info('Blog Post ID: ' . $blogPost->id);
        \Log::info('Blog Post Title: ' . $blogPost->title);
        
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
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'featured' => 'boolean',
        ]);

        // Başlık değiştiyse slug'ı da güncelle
        if ($request->title != $blogPost->title) {
            $slug = Str::slug($request->title);
            
            // Slug'ı benzersiz yap
            $count = 1;
            $originalSlug = $slug;
            while (BlogPost::where('slug', $slug)->where('id', '!=', $blogPost->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            
            $blogPost->slug = $slug;
        }

        $blogPost->title = $request->title;
        $blogPost->excerpt = $request->excerpt;
        $blogPost->content = $request->content;
        $blogPost->category = $request->category;
        $blogPost->featured = $request->has('featured');
        
        // Dosya yükleme işlemi
        if ($request->hasFile('image')) {
            // Eski resmi siliyoruz, eğer varsa
            if ($blogPost->image && file_exists(public_path($blogPost->image))) {
                unlink(public_path($blogPost->image));
            }
            
            // Yeni resmi yüklüyoruz
            $imageName = $blogPost->slug . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/blog'), $imageName);
            $blogPost->image = 'images/blog/' . $imageName;
        }
        
        // Yayın durumunu kontrol et
        if ($request->has('published')) {
            // Eğer daha önce yayınlanmamışsa şimdi yayınla
            if (!$blogPost->published_at) {
                $blogPost->published_at = now();
            }
        } else {
            // Yayından kaldır
            $blogPost->published_at = null;
        }
        
        $blogPost->save();

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog yazısı başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog yazısı başarıyla silindi.');
    }
}
