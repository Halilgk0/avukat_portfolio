@extends('admin.layouts.app')

@section('title', 'Site Ayarları')

@section('page_title', 'Site Ayarları')

@section('content')
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
        <h3 class="text-xl font-bold">Site Ayarları</h3>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-700 text-white px-3 py-1 rounded hover:bg-gray-600 transition flex items-center">
            <i class="fas fa-arrow-left mr-1"></i> Dashboard'a Dön
        </a>
    </div>

    <div class="p-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <!-- Site Name -->
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700 mb-1">Site Adı</label>
                    <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings['site_name']) }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('site_name') border-red-500 @enderror">
                    @error('site_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Site Logo -->
                <div>
                    <label for="site_logo" class="block text-sm font-medium text-gray-700 mb-1">Site Logosu</label>
                    
                    <div class="border border-gray-300 rounded-lg p-4 mb-4">
                        <div class="mb-4">
                            @if($settings['site_logo'])
                                <div class="mb-3">
                                    <p class="text-sm text-gray-600 mb-2">Mevcut Logo:</p>
                                    <div class="p-4 bg-gray-100 rounded-lg inline-block">
                                        <img src="{{ Storage::url($settings['site_logo']) }}" alt="Site Logo" class="max-h-24">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <a href="{{ route('admin.settings.remove-logo') }}" 
                                       onclick="return confirm('Logoyu kaldırmak istediğinizden emin misiniz?')"
                                       class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                        <i class="fas fa-trash mr-1"></i> Logoyu Kaldır
                                    </a>
                                </div>
                            @else
                                <p class="text-sm text-gray-600 mb-2">Henüz logo yüklenmemiş.</p>
                            @endif
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                @if($settings['site_logo'])
                                    Yeni Logo Yükle (Mevcut logoyu değiştirir)
                                @else
                                    Logo Yükle
                                @endif
                            </label>
                            <input type="file" name="site_logo" id="site_logo" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('site_logo') border-red-500 @enderror">
                            <p class="text-sm text-gray-500 mt-1">Maksimum dosya boyutu: 2MB. İzin verilen formatlar: JPG, PNG, GIF.</p>
                            @error('site_logo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="pt-4 border-t border-gray-200">
                    <button type="submit" class="w-full md:w-auto px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-save mr-2"></i> Ayarları Kaydet
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 