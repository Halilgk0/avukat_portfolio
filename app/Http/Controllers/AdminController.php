<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BlogPost;
use App\Models\LegalCase;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    private function checkAdmin()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Bu sayfaya erişim yetkiniz yok.');
        }
    }

    public function dashboard()
    {
        $stats = [
            'users_count' => User::count(),
            'blog_posts_count' => BlogPost::count(),
            'legal_cases_count' => LegalCase::count(),
            'contact_messages_count' => ContactMessage::count(),
            'unread_messages_count' => ContactMessage::where('is_read', false)->count(),
        ];

        $latest_posts = BlogPost::latest()->take(5)->get();
        $latest_cases = LegalCase::latest()->take(5)->get();
        $latest_messages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latest_posts', 'latest_cases', 'latest_messages'));
    }
}
