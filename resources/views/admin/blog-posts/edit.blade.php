@extends('admin.layouts.app')

@section('title', 'Blog Yazısı Düzenle')

@section('page_title', 'Blog Yazısı Düzenle')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <form action="{{ route('admin.blog-posts.update', $blogPost->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Başlık</label>
                <input type="text" name="title" id="title" value="{{ old('title', $blogPost->title) }}" required 
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
                    <option value="Ticaret Hukuku" {{ old('category', $blogPost->category) == 'Ticaret Hukuku' ? 'selected' : '' }}>Ticaret Hukuku</option>
                    <option value="Aile Hukuku" {{ old('category', $blogPost->category) == 'Aile Hukuku' ? 'selected' : '' }}>Aile Hukuku</option>
                    <option value="Ceza Hukuku" {{ old('category', $blogPost->category) == 'Ceza Hukuku' ? 'selected' : '' }}>Ceza Hukuku</option>
                    <option value="İş Hukuku" {{ old('category', $blogPost->category) == 'İş Hukuku' ? 'selected' : '' }}>İş Hukuku</option>
                    <option value="Borçlar Hukuku" {{ old('category', $blogPost->category) == 'Borçlar Hukuku' ? 'selected' : '' }}>Borçlar Hukuku</option>
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mb-6">
            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Özet</label>
            <textarea name="excerpt" id="excerpt" rows="3" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('excerpt') border-red-500 @enderror">{{ old('excerpt', $blogPost->excerpt) }}</textarea>
            @error('excerpt')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">İçerik</label>
            <textarea name="content" id="content" rows="10" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('content') border-red-500 @enderror">{{ old('content', $blogPost->content) }}</textarea>
            @error('content')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Görsel</label>
            @if($blogPost->image)
                <div class="mt-2 mb-4">
                    <img src="{{ asset($blogPost->image) }}" alt="{{ $blogPost->title }}" class="h-32 w-auto rounded-lg">
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
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <div class="flex items-center">
                    <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $blogPost->featured) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <label for="featured" class="ml-2 block text-sm text-gray-700">Öne Çıkan Yazı</label>
                </div>
                <p class="mt-1 text-xs text-gray-500">Öne çıkan yazılar ana sayfada görüntülenir.</p>
            </div>
            
            <div>
                <div class="flex items-center">
                    <input type="checkbox" name="published" id="published" value="1" {{ old('published', $blogPost->published_at) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <label for="published" class="ml-2 block text-sm text-gray-700">Yayında</label>
                </div>
                <p class="mt-1 text-xs text-gray-500">İşaretlenmezse taslak olarak kaydedilir.</p>
            </div>
        </div>
        
        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('admin.blog-posts.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">İptal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-200">
                Değişiklikleri Kaydet
            </button>
        </div>
    </form>
</div>
@endsection 