@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gray-900 text-white">
        <div class="absolute inset-0">
            <img src="{{ asset('images/blog-hero.jpg') }}" alt="Blog Background" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Hukuk Blogu</h1>
            <p class="text-xl mb-8">Güncel hukuki gelişmeler ve bilgilendirici makaleler</p>
        </div>
    </section>

    <!-- Blog Categories -->
    <section class="py-8 bg-gray-100">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('blog') }}" 
                   class="px-6 py-2 {{ !request('category') ? 'bg-gray-900 text-white' : 'bg-white text-gray-700' }} rounded-full hover:bg-gray-800 hover:text-white transition duration-300">
                    Tümü
                </a>
                @php
                    $categories = ['Ticaret Hukuku', 'Aile Hukuku', 'Ceza Hukuku', 'İş Hukuku'];
                @endphp
                @foreach($categories as $category)
                    <a href="{{ route('blog', ['category' => $category]) }}" 
                       class="px-6 py-2 {{ request('category') == $category ? 'bg-gray-900 text-white' : 'bg-white text-gray-700' }} rounded-full hover:bg-gray-800 hover:text-white transition duration-300">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Post -->
    @if($featuredPost)
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2">
                        <img src="{{ asset($featuredPost->image) }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover">
                    </div>
                    <div class="md:w-1/2 p-8">
                        <div class="text-sm text-gray-500 mb-2">{{ $featuredPost->published_at->format('d F Y') }}</div>
                        <h2 class="text-3xl font-bold mb-4">{{ $featuredPost->title }}</h2>
                        <p class="text-gray-600 mb-6">{{ $featuredPost->excerpt }}</p>
                        <div class="flex items-center mb-6">
                            <img src="{{ asset('images/lawyer-profile.jpg') }}" alt="Author" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <div class="font-semibold">Ekram Çakmak</div>
                                <div class="text-sm text-gray-500">{{ $featuredPost->category }}</div>
                            </div>
                        </div>
                        <a href="{{ route('blog.show', $featuredPost) }}" class="inline-block bg-gray-900 text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition duration-300">
                            Devamını Oku
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Blog Posts Grid -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            @if($posts->isEmpty())
                <div class="text-center py-12">
                    <h3 class="text-2xl text-gray-600">Bu kategoride henüz blog yazısı bulunmamaktadır.</h3>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="text-sm text-gray-500 mb-2">{{ $post->published_at->format('d F Y') }}</div>
                                <h3 class="text-xl font-bold mb-3">{{ $post->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ $post->excerpt }}</p>
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('blog.show', $post) }}" class="text-gray-900 font-semibold hover:text-gray-700">
                                        Devamını Oku →
                                    </a>
                                    <span class="text-sm text-gray-500">{{ $post->category }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Hukuki Gelişmelerden Haberdar Olun</h2>
            <p class="text-xl mb-8">Aylık bültenimize ücretsiz abone olun</p>
            
                @csrf
                <div class="flex gap-4">
                    <input type="email" name="email" placeholder="E-posta adresiniz" required 
                           class="flex-1 px-4 py-3 rounded-lg text-gray-900">
                    <button type="submit" 
                            class="bg-white text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                        Abone Ol
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
