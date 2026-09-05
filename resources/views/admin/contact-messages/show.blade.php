@extends('admin.layouts.app')

@section('title', 'İletişim Mesajı Detayı')

@section('page_title', 'İletişim Mesajı Detayı')

@section('content')
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
        <h3 class="text-xl font-bold">Mesaj #{{ $contactMessage->id }}</h3>
        <a href="{{ route('admin.contact-messages.index') }}" class="bg-gray-700 text-white px-3 py-1 rounded hover:bg-gray-600 transition flex items-center">
            <i class="fas fa-arrow-left mr-1"></i> Listeye Dön
        </a>
    </div>

    <div class="p-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Mesaj İçeriği -->
            <div class="md:col-span-2">
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-gray-100 px-4 py-3 border-b flex justify-between items-center">
                        <h3 class="font-bold text-lg">{{ $contactMessage->subject }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $contactMessage->is_read ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            <i class="fas fa-{{ $contactMessage->is_read ? 'check' : 'envelope' }} mr-1"></i>
                            {{ $contactMessage->is_read ? 'Okundu' : 'Okunmadı' }}
                        </span>
                    </div>
                    
                    <div class="bg-white p-4">
                        <div class="mb-4 text-sm text-gray-500">
                            <div class="mb-1">
                                <i class="fas fa-user text-gray-400 mr-1"></i> <strong>{{ $contactMessage->name }}</strong>
                            </div>
                            <div class="mb-1">
                                <i class="fas fa-envelope text-gray-400 mr-1"></i> <a href="mailto:{{ $contactMessage->email }}" class="text-blue-500 hover:underline">{{ $contactMessage->email }}</a>
                            </div>
                            <div class="mb-1">
                                <i class="fas fa-phone text-gray-400 mr-1"></i> <a href="tel:{{ $contactMessage->phone }}" class="text-blue-500 hover:underline">{{ $contactMessage->phone }}</a>
                            </div>
                            <div>
                                <i class="fas fa-calendar text-gray-400 mr-1"></i> {{ $contactMessage->created_at->format('d.m.Y H:i') }}
                            </div>
                        </div>
                        
                        <div class="border-t pt-4 mt-4">
                            <p class="whitespace-pre-wrap text-gray-700">{{ $contactMessage->message }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- İşlemler -->
            <div class="md:col-span-1">
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-gray-100 px-4 py-3 border-b">
                        <h3 class="font-bold">İşlemler</h3>
                    </div>
                    
                    <div class="p-4 space-y-3">
                        <a href="{{ route('admin.contact-messages.reply', $contactMessage) }}" class="w-full flex items-center justify-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            <i class="fas fa-reply mr-2"></i> E-posta ile Yanıtla
                        </a>
                        
                        <form action="{{ route('admin.contact-messages.toggle-read', $contactMessage) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full flex items-center justify-center bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                                <i class="fas fa-{{ $contactMessage->is_read ? 'envelope' : 'check' }} mr-2"></i> 
                                {{ $contactMessage->is_read ? 'Okunmadı Yap' : 'Okundu Yap' }}
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full flex items-center justify-center bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                                <i class="fas fa-trash mr-2"></i> Mesajı Sil
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="border rounded-lg overflow-hidden mt-4">
                    <div class="bg-gray-100 px-4 py-3 border-b">
                        <h3 class="font-bold">Hızlı İletişim</h3>
                    </div>
                    
                    <div class="p-4 space-y-3">
                        <a href="tel:{{ $contactMessage->phone }}" class="w-full flex items-center justify-center bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                            <i class="fas fa-phone mr-2"></i> Ara
                        </a>
                        
                        <a href="mailto:{{ $contactMessage->email }}" class="w-full flex items-center justify-center bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                            <i class="fas fa-envelope mr-2"></i> E-posta Gönder
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForm = document.querySelector('.delete-form');
        if (deleteForm) {
            deleteForm.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Bu mesajı silmek istediğinizden emin misiniz?')) {
                    this.submit();
                }
            });
        }
    });
</script>
@endpush 