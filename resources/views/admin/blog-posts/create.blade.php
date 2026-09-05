@extends('layouts.app')

@section('title', 'Yeni Blog Yazısı')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Yeni Blog Yazısı</h1>
            <p class="text-gray-600 mt-1">Yeni bir blog yazısı oluşturun</p>
        </div>
        <div class="flex space-x-3">
            <a href="/admin/blog-posts" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Geri Dön</a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Başlık</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category" id="category" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Kategori Seçin</option>
                    <option value="Ticaret Hukuku" {{ old('category') == 'Ticaret Hukuku' ? 'selected' : '' }}>Ticaret Hukuku</option>
                    <option value="Aile Hukuku" {{ old('category') == 'Aile Hukuku' ? 'selected' : '' }}>Aile Hukuku</option>
                    <option value="Ceza Hukuku" {{ old('category') == 'Ceza Hukuku' ? 'selected' : '' }}>Ceza Hukuku</option>
                    <option value="İş Hukuku" {{ old('category') == 'İş Hukuku' ? 'selected' : '' }}>İş Hukuku</option>
                    <option value="Borçlar Hukuku" {{ old('category') == 'Borçlar Hukuku' ? 'selected' : '' }}>Borçlar Hukuku</option>
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="excerpt" class="block text-sm font-medium text-gray-700">Özet</label>
                <textarea name="excerpt" id="excerpt" rows="3" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">İçerik</label>
                <textarea name="content" id="content" rows="10" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Görsel</label>
                <input type="file" name="image" id="image" accept=".jpg,.jpeg" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('image') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Sadece JPG/JPEG formatı desteklenmektedir.</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <div class="flex items-center">
                    <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="featured" class="ml-2 block text-sm text-gray-700">Öne Çıkan Yazı</label>
                </div>
            </div>

            <div class="mb-4">
                <div class="flex items-center">
                    <input type="checkbox" name="published" id="published" value="1" {{ old('published') ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="published" class="ml-2 block text-sm text-gray-700">Hemen Yayınla</label>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                    Yazıyı Kaydet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 