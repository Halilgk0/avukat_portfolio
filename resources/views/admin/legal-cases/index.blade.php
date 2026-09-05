@extends('admin.layouts.app')

@section('title', 'Davalar')

@section('page_title', 'Davalar')

@section('page_actions')
<a href="{{ route('admin.legal-cases.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg text-sm transition duration-200">
    <i class="fas fa-plus mr-1"></i> Yeni Dava Ekle
</a>
@endsection

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Başlık
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Kategori
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Durum
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tarih
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        İşlemler
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($cases as $case)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $case->title }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($case->description, 100) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $case->category }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @switch($case->status)
                                @case('ongoing')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Devam Ediyor
                                    </span>
                                    @break
                                @case('won')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Kazanıldı
                                    </span>
                                    @break
                                @case('lost')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Kaybedildi
                                    </span>
                                    @break
                                @case('settled')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Anlaşma
                                    </span>
                                    @break
                            @endswitch
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $case->created_at->format('d.m.Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('admin.legal-cases.edit', $case->id) }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                                    <i class="fas fa-edit mr-1"></i> Düzenle
                                </a>
                                
                                <form action="{{ route('admin.legal-cases.destroy', $case->id) }}" method="POST" onsubmit="return confirm('Bu davayı silmek istediğinize emin misiniz?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 flex items-center">
                                        <i class="fas fa-trash-alt mr-1"></i> Sil
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($cases->hasPages())
        <div class="mt-4">
            {{ $cases->links() }}
        </div>
    @endif
@endsection 