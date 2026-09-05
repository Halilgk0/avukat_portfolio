@extends('admin.layouts.app')

@section('title', 'Hakkımda Bölümü')

@section('page_title', 'Hakkımda Bölümü Düzenle')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Başlık</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $about->title ?? '') }}" required 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="lawyer_name" class="block text-sm font-medium text-gray-700 mb-1">Avukat İsmi</label>
                    <input type="text" name="lawyer_name" id="lawyer_name" value="{{ old('lawyer_name', $about->lawyer_name ?? '') }}" required 
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('lawyer_name') border-red-500 @enderror">
                    @error('lawyer_name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="lawyer_title" class="block text-sm font-medium text-gray-700 mb-1">Ünvan</label>
                <input type="text" name="lawyer_title" id="lawyer_title" value="{{ old('lawyer_title', $about->lawyer_title ?? '') }}" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('lawyer_title') border-red-500 @enderror">
                @error('lawyer_title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Ana İçerik</label>
                <textarea name="content" id="content" rows="5" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('content') border-red-500 @enderror">{{ old('content', $about->content ?? '') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Deneyim</label>
                <textarea name="experience" id="experience" rows="4"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('experience') border-red-500 @enderror">{{ old('experience', $about->experience ?? '') }}</textarea>
                <p class="mt-1 text-xs text-gray-500">Deneyimlerinizi yazın. HTML etiketleri kullanabilirsiniz.</p>
                @error('experience')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="education" class="block text-sm font-medium text-gray-700 mb-1">Eğitim</label>
                <textarea name="education" id="education" rows="4"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('education') border-red-500 @enderror">{{ old('education', $about->education ?? '') }}</textarea>
                <p class="mt-1 text-xs text-gray-500">Eğitim bilgilerinizi yazın. HTML etiketleri kullanabilirsiniz.</p>
                @error('education')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="certificates" class="block text-sm font-medium text-gray-700 mb-1">Sertifikalar ve Üyelikler</label>
                <textarea name="certificates" id="certificates" rows="4"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('certificates') border-red-500 @enderror">{{ old('certificates', $about->certificates ?? '') }}</textarea>
                <p class="mt-1 text-xs text-gray-500">Sertifika ve üyelik bilgilerinizi yazın. HTML etiketleri kullanabilirsiniz.</p>
                @error('certificates')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Profil Görseli</label>
                @if(isset($about->image) && $about->image)
                    <div class="mt-2 mb-4">
                        <img src="{{ Storage::url($about->image) }}" alt="{{ $about->lawyer_name }}" class="h-32 w-auto rounded-lg">
                        <p class="mt-1 text-xs text-gray-500">Mevcut görsel</p>
                    </div>
                @endif
                <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('image') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Önerilen boyut: 600x800px. Yeni bir görsel yüklemezseniz, mevcut görsel korunacaktır.</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-800 mr-4">Geri Dön</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-200">
                    Değişiklikleri Kaydet
                </button>
            </div>
        </form>
    </div>
@endsection 