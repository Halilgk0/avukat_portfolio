@extends('layouts.app')

@section('title', 'Hizmetler')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gray-900 text-white">
        <div class="absolute inset-0">
            <img src="{{ asset('images/services-hero.jpg') }}" alt="Services Background" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Hukuki Hizmetlerimiz</h1>
            <p class="text-xl mb-8">Geniş kapsamlı hukuki çözümler ve danışmanlık hizmetleri</p>
        </div>
    </section>

    <!-- Main Services -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Ticaret Hukuku -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <div class="text-gray-900 mb-6">
                        <i class="fas fa-building text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Ticaret Hukuku</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li>• Şirket Kuruluşları</li>
                        <li>• Ticari Sözleşmeler</li>
                        <li>• Şirket Birleşmeleri</li>
                        <li>• İflas ve Konkordato</li>
                        <li>• Ticari Uyuşmazlıklar</li>
                    </ul>
                </div>

                <!-- Aile Hukuku -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <div class="text-gray-900 mb-6">
                        <i class="fas fa-users text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Aile Hukuku</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li>• Boşanma Davaları</li>
                        <li>• Nafaka Hukuku</li>
                        <li>• Velayet Davaları</li>
                        <li>• Mal Paylaşımı</li>
                        <li>• Aile İçi Sorunlar</li>
                    </ul>
                </div>

                <!-- Ceza Hukuku -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <div class="text-gray-900 mb-6">
                        <i class="fas fa-gavel text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Ceza Hukuku</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li>• Ağır Ceza Davaları</li>
                        <li>• Ekonomik Suçlar</li>
                        <li>• Siber Suçlar</li>
                        <li>• Temyiz İşlemleri</li>
                        <li>• Savunma Hizmetleri</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Services -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Diğer Uzmanlık Alanlarımız</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- İş Hukuku -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                    <h3 class="font-bold mb-3">İş Hukuku</h3>
                    <p class="text-gray-600">İşçi-işveren ilişkileri, iş sözleşmeleri, tazminat davaları</p>
                </div>

                <!-- Gayrimenkul Hukuku -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                    <h3 class="font-bold mb-3">Gayrimenkul Hukuku</h3>
                    <p class="text-gray-600">Tapu işlemleri, kira anlaşmazlıkları, kat mülkiyeti</p>
                </div>

                <!-- Miras Hukuku -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                    <h3 class="font-bold mb-3">Miras Hukuku</h3>
                    <p class="text-gray-600">Miras paylaşımı, vasiyetname, veraset ilamı</p>
                </div>

                <!-- İdare Hukuku -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                    <h3 class="font-bold mb-3">İdare Hukuku</h3>
                    <p class="text-gray-600">İdari davalar, kamulaştırma, imar hukuku</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Çalışma Sürecimiz</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-900 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold">1</span>
                    </div>
                    <h3 class="font-bold mb-2">İlk Görüşme</h3>
                    <p class="text-gray-600">Davanızı detaylı olarak dinler ve analiz ederiz</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-900 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold">2</span>
                    </div>
                    <h3 class="font-bold mb-2">Strateji Belirleme</h3>
                    <p class="text-gray-600">En uygun hukuki stratejiyi belirleriz</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-900 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold">3</span>
                    </div>
                    <h3 class="font-bold mb-2">Hukuki Süreç</h3>
                    <p class="text-gray-600">Davanızı profesyonel şekilde yürütürüz</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-900 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold">4</span>
                    </div>
                    <h3 class="font-bold mb-2">Sonuç</h3>
                    <p class="text-gray-600">Davanızı başarıyla sonuçlandırırız</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Hukuki Desteğe mi İhtiyacınız Var?</h2>
            <p class="text-xl mb-8">Size en uygun çözümü sunmak için hazırız</p>
            <a href="{{ route('contact') }}" class="bg-white text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                Ücretsiz Danışın
            </a>
        </div>
    </section>
@endsection
