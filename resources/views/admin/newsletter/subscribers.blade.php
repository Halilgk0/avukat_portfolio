@extends('admin.layouts.app')

@section('title', 'Bülten Aboneleri')

@section('page_title', 'Bülten Aboneleri')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Tüm Aboneler</h2>
            <div class="mt-2 md:mt-0">
                <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg text-sm transition duration-200">
                    <i class="fas fa-download mr-1"></i> CSV İndir
                </a>
            </div>
        </div>
        
        @if(count($subscribers) > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="text-left bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-gray-600 text-sm font-semibold">E-posta</th>
                            <th class="px-4 py-3 text-gray-600 text-sm font-semibold">İsim</th>
                            <th class="px-4 py-3 text-gray-600 text-sm font-semibold">Abone Tarihi</th>
                            <th class="px-4 py-3 text-gray-600 text-sm font-semibold">Onaylandı</th>
                            <th class="px-4 py-3 text-gray-600 text-sm font-semibold">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($subscribers as $subscriber)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $subscriber->email }}</td>
                            <td class="px-4 py-3">{{ $subscriber->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $subscriber->created_at->format('d.m.Y') }}</td>
                            <td class="px-4 py-3">
                                @if($subscriber->confirmed_at)
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Evet</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Hayır</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <form action="{{ route('admin.newsletter.subscribers.remove', $subscriber->id) }}" method="POST" onsubmit="return confirm('Bu aboneyi silmek istediğinize emin misiniz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-8 text-center text-gray-500">
                <p>Henüz abone bulunmamaktadır.</p>
            </div>
        @endif
    </div>
</div>
@endsection 