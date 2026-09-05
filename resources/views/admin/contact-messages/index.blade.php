@extends('admin.layouts.app')

@section('title', 'İletişim Mesajları')

@section('page_title', 'İletişim Mesajları')

@section('content')
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="bg-gray-800 text-white px-6 py-4 flex items-center justify-between">
        <h3 class="text-xl font-bold">
            İletişim Mesajları
            @if(count($messages) > 0)
                <span class="text-sm bg-blue-500 text-white rounded-full px-2 py-1 ml-2">{{ $messages->total() }}</span>
            @endif
        </h3>
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-700 text-white px-3 py-1 rounded hover:bg-gray-600 transition flex items-center">
                <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
            </a>
        </div>
    </div>

    <div class="p-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            @if(count($messages) > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">İsim</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">E-posta</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefon</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Konu</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarih</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durum</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($messages as $message)
                            <tr class="{{ $message->is_read ? '' : 'bg-yellow-50' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $message->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $message->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="mailto:{{ $message->email }}" class="text-blue-500 hover:underline">{{ $message->email }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="tel:{{ $message->phone }}" class="text-blue-500 hover:underline">{{ $message->phone }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Illuminate\Support\Str::limit($message->subject, 30) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $message->created_at->format('d.m.Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $message->is_read ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        <i class="fas fa-{{ $message->is_read ? 'check' : 'envelope' }} mr-1"></i>
                                        {{ $message->is_read ? 'Okundu' : 'Okunmadı' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.contact-messages.show', $message) }}" class="text-blue-600 hover:text-blue-900" title="Görüntüle">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.contact-messages.reply', $message) }}" class="text-indigo-600 hover:text-indigo-900" title="Yanıtla">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                        <form action="{{ route('admin.contact-messages.toggle-read', $message) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-{{ $message->is_read ? 'gray' : 'green' }}-600 hover:text-{{ $message->is_read ? 'gray' : 'green' }}-900" title="{{ $message->is_read ? 'Okunmadı Yap' : 'Okundu Yap' }}">
                                                <i class="fas fa-{{ $message->is_read ? 'envelope' : 'check' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" title="Sil">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="mt-4">
                    {{ $messages->links() }}
                </div>
            @else
                <div class="text-center py-10">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Mesaj bulunamadı</h3>
                    <p class="mt-1 text-sm text-gray-500">Henüz hiç iletişim mesajı bulunmamaktadır.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Bu mesajı silmek istediğinizden emin misiniz?')) {
                    this.submit();
                }
            });
        });
    });
</script>
@endpush 