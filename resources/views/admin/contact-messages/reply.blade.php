@extends('admin.layouts.app')

@section('title', 'E-posta ile Yanıtla')

@section('page_title', 'E-posta ile Yanıtla')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-xl font-bold">{{ $contactMessage->subject }} (Yanıt)</h1>
        <a href="{{ route('admin.contact-messages.show', $contactMessage) }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
            <i class="fas fa-arrow-left mr-1"></i> Geri Dön
        </a>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-gray-100 p-4 rounded-lg mb-6">
        <div class="mb-3">
            <span class="font-semibold">Gönderen:</span> {{ $contactMessage->name }} &lt;{{ $contactMessage->email }}&gt;
        </div>
        <div class="mb-3">
            <span class="font-semibold">Konu:</span> {{ $contactMessage->subject }}
        </div>
        <div class="mb-3">
            <span class="font-semibold">Tarih:</span> {{ $contactMessage->created_at->format('d.m.Y H:i') }}
        </div>
        <div>
            <span class="font-semibold">Mesaj:</span>
            <div class="mt-2 p-3 bg-white rounded border">
                {!! nl2br(e($contactMessage->message)) !!}
            </div>
        </div>
    </div>

    <form action="{{ route('admin.contact-messages.send-reply', $contactMessage) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="message" class="block text-gray-700 font-medium mb-2">Yanıtınız</label>
            <textarea name="message" id="message" rows="10" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
            @error('message')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-paper-plane mr-2"></i> Yanıtı Gönder
            </button>
        </div>
    </form>
</div>
@endsection 