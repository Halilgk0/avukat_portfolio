@extends('admin.layouts.app')

@section('title', 'Yeni Kullanıcı')

@section('page_title', 'Yeni Kullanıcı Ekle')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <form action="{{ route('admin.users.store') }}" method="POST" class="p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Ad Soyad</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-posta</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Şifre</label>
                <input type="password" name="password" id="password" required 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Şifre Tekrar</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
        </div>
        
        <div class="mb-6">
            <div class="flex items-center">
                <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <label for="is_admin" class="ml-2 block text-sm text-gray-700">Admin olarak ata</label>
            </div>
            <p class="mt-1 text-xs text-gray-500">Admin kullanıcılar tüm içeriği yönetme yetkisine sahiptir.</p>
        </div>
        
        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">İptal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition duration-200">
                Kullanıcı Oluştur
            </button>
        </div>
    </form>
</div>
@endsection 