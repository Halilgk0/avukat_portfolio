<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\LegalCase;
use App\Models\AboutSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $about = AboutSection::where('is_active', true)->first();
        return view('home', compact('about'));
    }

    public function about()
    {
        $about = AboutSection::where('is_active', true)->first();
        return view('about', compact('about'));
    }

    public function services()
    {
        return view('services');
    }

    public function cases(Request $request)
    {
        $query = LegalCase::query();
        
        if ($request->category && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        $cases = $query->latest()->paginate(6);
        $categories = LegalCase::distinct()->pluck('category');
        
        return view('cases', compact('cases', 'categories'));
    }

    public function blog(Request $request)
    {
        $query = BlogPost::query();

        if ($request->category) {
            $query->where('category', $request->category);
        }

        $featuredPost = BlogPost::where('featured', true)
            ->latest('published_at')
            ->first();
            
        $posts = $query->where('featured', false)
            ->latest('published_at')
            ->paginate(6);

        return view('blog', compact('featuredPost', 'posts'));
    }

    public function showPost(BlogPost $post)
    {
        $relatedPosts = BlogPost::where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->limit(2)
            ->latest('published_at')
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email'
        ]);

        try {
            // Burada e-posta adresi veritabanına kaydedilebilir
            // veya bir e-posta pazarlama servisine gönderilebilir

            return back()->with('success', 'Bültenimize başarıyla abone oldunuz!');
        } catch (\Exception $e) {
            return back()->with('error', 'Bir hata oluştu. Lütfen tekrar deneyin.');
        }
    }
}
