@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page_title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-sm p-6 flex items-center">
        <div class="rounded-full bg-blue-100 p-3 mr-4">
            <i class="fas fa-newspaper text-blue-500 text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-500 text-sm">Blog Yazıları</h3>
            <p class="text-2xl font-bold">{{ $stats['blog_posts_count'] }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6 flex items-center">
        <div class="rounded-full bg-green-100 p-3 mr-4">
            <i class="fas fa-gavel text-green-500 text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-500 text-sm">Davalar</h3>
            <p class="text-2xl font-bold">{{ $stats['legal_cases_count'] }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6 flex items-center">
        <div class="rounded-full bg-purple-100 p-3 mr-4">
            <i class="fas fa-users text-purple-500 text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-500 text-sm">Kullanıcılar</h3>
            <p class="text-2xl font-bold">{{ $stats['users_count'] }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-sm p-6 flex items-center">
        <div class="rounded-full bg-yellow-100 p-3 mr-4">
            <i class="fas fa-envelope text-yellow-500 text-xl"></i>
        </div>
        <div>
            <h3 class="text-gray-500 text-sm">İletişim Mesajları</h3>
            <p class="text-2xl font-bold">{{ $stats['contact_messages_count'] }} 
                @if($stats['unread_messages_count'] > 0)
                <span class="text-sm text-yellow-500 font-normal">({{ $stats['unread_messages_count'] }} okunmamış)</span>
                @endif
            </p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
    <!-- Son Blog Yazıları -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Son Blog Yazıları</h2>
            <a href="{{ route('admin.blog-posts.index') }}" class="text-blue-500 hover:text-blue-700 text-sm">Tümünü Gör</a>
        </div>
        
        @if($latest_posts->count() > 0)
            <div class="divide-y">
                @foreach($latest_posts as $post)
                <div class="py-3">
                    <div class="flex justify-between">
                        <div>
                            <h3 class="font-semibold">{{ $post->title }}</h3>
                            <p class="text-gray-500 text-sm">
                                {{ $post->category }} | {{ $post->published_at->format('d.m.Y') }}
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('admin.blog-posts.edit', $post->id) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">Henüz blog yazısı bulunmamaktadır.</p>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Son Davalar -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Son Davalar</h2>
            <a href="{{ route('admin.legal-cases.index') }}" class="text-blue-500 hover:text-blue-700 text-sm">Tümünü Gör</a>
        </div>
        
        @if($latest_cases->count() > 0)
            <div class="divide-y">
                @foreach($latest_cases as $case)
                <div class="py-3">
                    <div class="flex justify-between">
                        <div>
                            <h3 class="font-semibold">{{ $case->title }}</h3>
                            <p class="text-gray-500 text-sm">
                                {{ $case->category }} | 
                                <span class="
                                    @if($case->status == 'ongoing') text-yellow-500
                                    @elseif($case->status == 'won') text-green-500
                                    @elseif($case->status == 'lost') text-red-500
                                    @else text-blue-500
                                    @endif
                                ">
                                    {{ ucfirst($case->status) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('admin.legal-cases.edit', $case->id) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">Henüz dava bulunmamaktadır.</p>
        @endif
    </div>
    
    <!-- Son İletişim Mesajları -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Son İletişim Mesajları</h2>
            <a href="{{ route('admin.contact-messages.index') }}" class="text-blue-500 hover:text-blue-700 text-sm">Tümünü Gör</a>
        </div>
        
        @if($latest_messages->count() > 0)
            <div class="divide-y">
                @foreach($latest_messages as $message)
                <div class="py-3">
                    <div class="flex justify-between">
                        <div>
                            <h3 class="font-semibold">{{ Str::limit($message->subject, 40) }}</h3>
                            <p class="text-gray-500 text-sm">
                                {{ $message->name }} | {{ $message->created_at->format('d.m.Y') }}
                                @unless($message->is_read)
                                    <span class="ml-2 inline-block w-2 h-2 bg-yellow-500 rounded-full"></span>
                                @endunless
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-4">Henüz iletişim mesajı bulunmamaktadır.</p>
        @endif
    </div>
</div>

<!-- Blog Yazıları Kartı -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="p-5 border-b border-gray-100">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-700">Blog Yazıları</h3>
            <a href="{{ route('admin.blog-posts.index') }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                Tümünü Gör
            </a>
        </div>
    </div>
    <div class="p-5">
        <p class="text-3xl font-bold text-gray-800 mb-1">{{ $stats['blog_posts_count'] }}</p>
        <p class="text-sm text-gray-500">Toplam blog yazısı</p>
        
        <div class="mt-6">
            <a href="{{ route('admin.blog-posts.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg text-sm transition duration-200 inline-flex items-center">
                <i class="fas fa-plus mr-2"></i> Yeni Yazı Ekle
            </a>
        </div>
    </div>
</div>

<!-- Hakkımda Kartı -->
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="p-5 border-b border-gray-100">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-700">Hakkımda</h3>
            <a href="{{ route('admin.about.index') }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                Düzenle
            </a>
        </div>
    </div>
    <div class="p-5">
        <p class="text-sm text-gray-600 mb-4">Hakkımda bölümünüzü güncelleyin, avukatlık deneyimlerinizi, eğitim bilgilerinizi ve profesyonel bilgilerinizi paylaşın.</p>
        
        <div class="mt-4">
            <a href="{{ route('admin.about.index') }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg text-sm transition duration-200 inline-flex items-center">
                <i class="fas fa-edit mr-2"></i> Hakkımda Bölümünü Düzenle
            </a>
        </div>
    </div>
</div>
@endsection 