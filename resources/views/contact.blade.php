@extends('layouts.app')

@section('title', 'İletişim')

@section('content')
    <!-- Contact Section -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold mb-4">İletişime Geçin</h1>
                <p class="text-gray-600">Hukuki danışmanlık için direkt iletişim bilgilerimizden bize ulaşabilirsiniz.</p>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Contact Information -->
            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-4">İletişim Bilgileri</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-gray-900 mt-1 mr-4 text-xl"></i>
                                <div>
                                    <h4 class="font-semibold">Adres</h4>
                                    <p class="text-gray-600">İstanbul, Türkiye</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-phone text-gray-900 mt-1 mr-4 text-xl"></i>
                                <div>
                                    <h4 class="font-semibold">Telefon</h4>
                                    <p class="text-gray-600">+90 XXX XXX XX XX</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-envelope text-gray-900 mt-1 mr-4 text-xl"></i>
                                <div>
                                    <h4 class="font-semibold">E-posta</h4>
                                    <p class="text-gray-600">info@avukat.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-4">Çalışma Saatleri</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pazartesi - Cuma</span>
                                <span class="font-semibold">09:00 - 18:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Cumartesi</span>
                                <span class="font-semibold">10:00 - 14:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pazar</span>
                                <span class="font-semibold">Kapalı</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="mt-12 bg-white p-8 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-6">Bize Mesaj Gönderin</h3>
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-gray-700 font-medium mb-2">Adınız Soyadınız *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-gray-700 font-medium mb-2">E-posta Adresiniz *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-gray-700 font-medium mb-2">Telefon Numaranız *</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="subject" class="block text-gray-700 font-medium mb-2">Konu *</label>
                                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 @error('subject') border-red-500 @enderror">
                                @error('subject')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="message" class="block text-gray-700 font-medium mb-2">Mesajınız *</label>
                            <textarea name="message" id="message" rows="5" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="submit" class="bg-gray-900 text-white font-bold py-3 px-8 rounded-lg hover:bg-gray-800 transition duration-300">
                                Gönder
                            </button>
                        </div>
                    </form>
                </div>

                <div class="mt-8 bg-white p-8 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Hızlı İletişim</h3>
                    <div class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-6 mt-4">
                        <a href="tel:+90XXXXXXXXXX" class="bg-gray-900 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-800 transition duration-300 flex items-center">
                            <i class="fas fa-phone mr-2"></i> Hemen Ara
                        </a>
                        <a href="mailto:info@avukat.com" class="bg-gray-900 text-white font-bold py-3 px-6 rounded-lg hover:bg-gray-800 transition duration-300 flex items-center">
                            <i class="fas fa-envelope mr-2"></i> E-posta Gönder
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold">Konum</h2>
            </div>
            <div class="h-96 bg-gray-300 rounded-lg overflow-hidden">
                <!-- Add your Google Maps or other map embed code here -->
                <div class="w-full h-full flex items-center justify-center">
                    <p class="text-gray-600">Harita buraya eklenecek</p>
                </div>
            </div>
        </div>
    </section>
@endsection
