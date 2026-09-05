@extends('admin.layouts.app')

@section('title', 'Dava Düzenle')

@section('page_title', 'Dava Düzenle')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <form action="{{ route('admin.legal-cases.update', $legalCase->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Dava Başlığı</label>
                <input type="text" name="title" id="title" value="{{ old('title', $legalCase->title) }}" required 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category" id="category" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('category') border-red-500 @enderror">
                    <option value="">Kategori Seçin</option>
                    <option value="Ceza Hukuku" {{ old('category', $legalCase->category) == 'Ceza Hukuku' ? 'selected' : '' }}>Ceza Hukuku</option>
                    <option value="Aile Hukuku" {{ old('category', $legalCase->category) == 'Aile Hukuku' ? 'selected' : '' }}>Aile Hukuku</option>
                    <option value="Ticaret Hukuku" {{ old('category', $legalCase->category) == 'Ticaret Hukuku' ? 'selected' : '' }}>Ticaret Hukuku</option>
                    <option value="İş Hukuku" {{ old('category', $legalCase->category) == 'İş Hukuku' ? 'selected' : '' }}>İş Hukuku</option>
                    <option value="Borçlar Hukuku" {{ old('category', $legalCase->category) == 'Borçlar Hukuku' ? 'selected' : '' }}>Borçlar Hukuku</option>
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Açıklama</label>
            <textarea name="description" id="description" rows="3" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('description') border-red-500 @enderror">{{ old('description', $legalCase->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">İçerik</label>
            <textarea name="content" id="content" rows="6" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('content') border-red-500 @enderror">{{ old('content', $legalCase->content) }}</textarea>
            @error('content')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Durum</label>
                <select name="status" id="status" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('status') border-red-500 @enderror">
                    <option value="">Durum Seçin</option>
                    <option value="ongoing" {{ old('status', $legalCase->status) == 'ongoing' ? 'selected' : '' }}>Devam Ediyor</option>
                    <option value="won" {{ old('status', $legalCase->status) == 'won' ? 'selected' : '' }}>Kazanıldı</option>
                    <option value="lost" {{ old('status', $legalCase->status) == 'lost' ? 'selected' : '' }}>Kaybedildi</option>
                    <option value="settled" {{ old('status', $legalCase->status) == 'settled' ? 'selected' : '' }}>Anlaşma</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="case_date" class="block text-sm font-medium text-gray-700 mb-1">Dava Tarihi</label>
                <input type="date" name="case_date" id="case_date" value="{{ old('case_date', $legalCase->case_date ? $legalCase->case_date->format('Y-m-d') : '') }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('case_date') border-red-500 @enderror">
                @error('case_date')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mb-6">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Görsel</label>
            @if($legalCase->image)
                <div class="mt-2 mb-4">
                    <img src="{{ asset($legalCase->image) }}" alt="{{ $legalCase->title }}" class="h-32 w-auto rounded-lg">
                    <p class="mt-1 text-xs text-gray-500">Mevcut görsel</p>
                </div>
            @endif
            <input type="file" name="image" id="image" accept=".jpg,.jpeg" 
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('image') border-red-500 @enderror">
            <p class="mt-1 text-xs text-gray-500">Sadece JPG/JPEG formatı desteklenmektedir. Yeni bir görsel yüklemezseniz, mevcut görsel korunacaktır.</p>
            @error('image')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('admin.legal-cases.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">İptal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-200">
                Değişiklikleri Kaydet
            </button>
        </div>
    </form>
</div>
@endsection 