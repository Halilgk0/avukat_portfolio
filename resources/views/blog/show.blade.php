@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <!-- Blog Post Header -->
    <section class="relative py-20 bg-gray-900 text-white">
        <div class="absolute inset-0">
            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative container mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <div class="text-sm mb-4">{{ $post->published_at->format('d F Y') }}</div>
                <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $post->title }}</h1>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/lawyer-profile.jpg') }}" alt="Author" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <div class="font-semibold">Av. [İsim Soyisim]</div>
                        <div class="text-sm opacity-75">{{ $post->category }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Post Content -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">
                <div class="prose prose-lg mx-auto">
                    {!! $post->content !!}
                </div>

                <!-- Share Buttons -->
                <div class="border-t border-b border-gray-200 py-8 my-8">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Bu Yazıyı Paylaş:</span>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-600 hover:text-blue-600">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-blue-400">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-blue-700">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-green-600">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Author Bio -->
                <div class="bg-gray-100 p-8 rounded-lg my-8">
                    <div class="flex items-start">
                        <img src="{{ asset('images/lawyer-profile.jpg') }}" alt="Author" class="w-20 h-20 rounded-full mr-6">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Av. [İsim Soyisim]</h3>
                            <p class="text-gray-600 mb-4">20 yıllık hukuk tecrübesiyle, çeşitli alanlarda uzmanlaşmış bir hukuk profesyoneli. Düzenli olarak hukuki gelişmeleri ve önemli dava süreçlerini blog yazılarıyla paylaşmaktadır.</p>
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-600 hover:text-gray-900">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-gray-900">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Posts -->
                <div class="my-12">
                    <h2 class="text-2xl font-bold mb-6">İlgili Yazılar</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Related Post 1 -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ asset('images/blog-1.jpg') }}" alt="Related Post 1" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="font-bold mb-2">İlgili Yazı Başlığı 1</h3>
                                <p class="text-gray-600 mb-4">Kısa açıklama metni...</p>
                                <a href="#" class="text-gray-900 font-semibold hover:text-gray-700">Devamını Oku →</a>
                            </div>
                        </div>

                        <!-- Related Post 2 -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ asset('images/blog-2.jpg') }}" alt="Related Post 2" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="font-bold mb-2">İlgili Yazı Başlığı 2</h3>
                                <p class="text-gray-600 mb-4">Kısa açıklama metni...</p>
                                <a href="#" class="text-gray-900 font-semibold hover:text-gray-700">Devamını Oku →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Hukuki Gelişmelerden Haberdar Olun</h2>
            <p class="text-xl mb-8">Aylık bültenimize ücretsiz abone olun</p>
            <form class="max-w-lg mx-auto">
                <div class="flex gap-4">
                    <input type="email" placeholder="E-posta adresiniz" class="flex-1 px-4 py-3 rounded-lg text-gray-900">
                    <button type="submit" class="bg-white text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                        Abone Ol
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
