@extends('layouts.app')

@section('title', 'Hakkımda')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gray-900 text-white">
        <div class="absolute inset-0">
            <img src="{{ asset('images/about-hero.jpg') }}" alt="About Background" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative container mx-auto px-6">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $about->lawyer_name ?? 'Av. [İsim Soyisim]' }}</h1>
                <p class="text-xl mb-8">{{ $about->lawyer_title ?? '20 yıllık hukuki tecrübe ve uzmanlık' }}</p>
            </div>
        </div>
    </section>

    <!-- Professional Experience -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold mb-6">{{ $about->title ?? 'Profesyonel Deneyim' }}</h2>
                    <p class="text-gray-600 mb-6">{{ $about->content ?? '20 yılı aşkın süredir, müvekkillerime en yüksek kalitede hukuki hizmet sunmaktayım. Her davayı titizlikle ele alarak, müvekkillerimin haklarını en iyi şekilde korumak için çalışıyorum.' }}</p>
                    @if($about && $about->experience)
                        {!! $about->experience !!}
                    @else
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                                <span>Yüzlerce başarılı dava sonucu</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                                <span>Geniş hukuki uzmanlık alanları</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-green-600 mt-1 mr-3"></i>
                                <span>Müvekkil odaklı yaklaşım</span>
                            </li>
                        </ul>
                    @endif
                </div>
                <div>
                    @if($about && $about->image)
                        <img src="{{ Storage::url($about->image) }}" alt="{{ $about->lawyer_name }}" class="rounded-lg shadow-xl">
                    @else
                        <img src="{{ asset('images/lawyer-profile.jpg') }}" alt="Lawyer Profile" class="rounded-lg shadow-xl">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Education & Certificates -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Eğitim ve Sertifikalar</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Eğitim</h3>
                    @if($about && $about->education)
                        {!! $about->education !!}
                    @else
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <div class="mr-4">
                                    <span class="text-gray-600">2000-2005</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Hukuk Fakültesi</h4>
                                    <p class="text-gray-600">[Üniversite Adı]</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <div class="mr-4">
                                    <span class="text-gray-600">2005-2006</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold">Avukatlık Stajı</h4>
                                    <p class="text-gray-600">[Baro Adı]</p>
                                </div>
                            </li>
                        </ul>
                    @endif
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Sertifikalar ve Üyelikler</h3>
                    @if($about && $about->certificates)
                        {!! $about->certificates !!}
                    @else
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fas fa-certificate text-yellow-500 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold">İstanbul Barosu Üyeliği</h4>
                                    <p class="text-gray-600">2006 - Günümüz</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-certificate text-yellow-500 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold">Arabuluculuk Sertifikası</h4>
                                    <p class="text-gray-600">2018</p>
                                </div>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Values -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Değerlerimiz</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-gray-900 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-balance-scale text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Adalet</h3>
                    <p class="text-gray-600">Her davanın arkasında bir insan hikayesi olduğunun bilincindeyiz.</p>
                </div>
                <div class="text-center">
                    <div class="bg-gray-900 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-handshake text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Güven</h3>
                    <p class="text-gray-600">Müvekkillerimizle güvene dayalı, şeffaf bir ilişki kurarız.</p>
                </div>
                <div class="text-center">
                    <div class="bg-gray-900 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-award text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Uzmanlık</h3>
                    <p class="text-gray-600">Her davaya profesyonel ve uzman yaklaşımla hazırlanırız.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
