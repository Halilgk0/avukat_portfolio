@extends('layouts.app')

@section('title', 'Başarılı Davalar')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gray-900 text-white">
        <div class="absolute inset-0">
            <img src="{{ asset('images/cases-hero.jpg') }}" alt="Cases Background" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Başarıyla sonuçlandırdığımız dava örnekleri</h1>
            <p class="text-xl mb-8">Müvekkillerimizin haklarını korumak için verdiğimiz başarılı mücadeleler</p>
        </div>
    </section>

    <!-- Category Filters -->
    <section class="py-8 bg-gray-100">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('cases') }}" 
                   class="px-6 py-2 {{ !request('category') ? 'bg-gray-900 text-white' : 'bg-white text-gray-700' }} rounded-full hover:bg-gray-800 hover:text-white transition duration-300">
                    Tümü
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('cases', ['category' => $category]) }}" 
                       class="px-6 py-2 {{ request('category') == $category ? 'bg-gray-900 text-white' : 'bg-white text-gray-700' }} rounded-full hover:bg-gray-800 hover:text-white transition duration-300">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Cases Grid -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($cases as $case)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <div class="text-sm text-gray-500 mb-2">{{ $case->category }}</div>
                            <h3 class="text-xl font-bold mb-3">{{ $case->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $case->description }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-green-600 font-semibold">{{ $case->status }}</span>
                                <span class="text-gray-500">{{ $case->year }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $cases->links() }}
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Hukuki Yardıma mı İhtiyacınız Var?</h2>
            <p class="text-xl mb-8">Size nasıl yardımcı olabileceğimizi öğrenmek için bizimle iletişime geçin</p>
            <a href="{{ route('contact') }}" class="inline-block bg-white text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                İletişime Geçin
            </a>
        </div>
    </section>
@endsection
