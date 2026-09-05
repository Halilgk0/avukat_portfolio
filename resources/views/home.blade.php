@extends('layouts.app')

@section('title', 'Ana Sayfa')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gray-900 text-white py-32">
        <div class="absolute inset-0">
            <img src="{{ asset('images/lawyer-hero.jpg') }}" alt="Lawyer Background" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Hukuki Çözüm Ortağınız</h1>
            <p class="text-xl mb-8">Profesyonel hukuk danışmanlığı ve temsil hizmetleri</p>
            <a href="{{ route('contact') }}" class="bg-white text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                Randevu Alın
            </a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Uzmanlık Alanlarımız</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <i class="fas fa-building text-3xl text-gray-900 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Ticaret Hukuku</h3>
                    <p class="text-gray-600">Şirketler hukuku, sözleşmeler ve ticari uyuşmazlıklar konusunda uzman danışmanlık.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <i class="fas fa-users text-3xl text-gray-900 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Aile Hukuku</h3>
                    <p class="text-gray-600">Boşanma, velayet ve nafaka davalarında profesyonel hukuki destek.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <i class="fas fa-gavel text-3xl text-gray-900 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Ceza Hukuku</h3>
                    <p class="text-gray-600">Ceza davalarında savunma ve hukuki temsil hizmetleri.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/2 mb-8 md:mb-0">
                    @if($about && $about->image)
                        <img src="{{ Storage::url($about->image) }}" alt="{{ $about->lawyer_name }}" class="rounded-lg shadow-lg">
                    @else
                        <img src="{{ asset('images/lawyer-profile.jpg') }}" alt="Lawyer Profile" class="rounded-lg shadow-lg">
                    @endif
                </div>
                <div class="w-full md:w-1/2 md:pl-12">
                    <h2 class="text-3xl font-bold mb-6">{{ $about->title ?? 'Hakkımda' }}</h2>
                    <p class="text-gray-600 mb-6">{{ $about->content ?? '20 yılı aşkın tecrübemle müvekkillerime en iyi hukuki hizmeti sunmaktayım. Hukuk fakültesinden mezun olduktan sonra, çeşitli alanlarda uzmanlaşarak geniş bir bilgi birikimine sahip oldum.' }}</p>
                    <a href="{{ route('about') }}" class="bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300">
                        Daha Fazla Bilgi
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">500+</div>
                    <div class="text-gray-600">Başarılı Dava</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">20+</div>
                    <div class="text-gray-600">Yıllık Tecrübe</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">1000+</div>
                    <div class="text-gray-600">Mutlu Müvekkil</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">50+</div>
                    <div class="text-gray-600">Kurumsal Müşteri</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Hukuki Danışmanlık İçin</h2>
            <p class="text-xl mb-8">Hemen iletişime geçin, size yardımcı olalım.</p>
            <a href="{{ route('contact') }}" class="bg-white text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                İletişime Geçin
            </a>
        </div>
    </section>
@endsection
