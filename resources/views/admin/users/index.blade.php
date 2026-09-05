@extends('admin.layouts.app')

@section('title', 'Kullanıcılar')

@section('page_title', 'Kullanıcılar')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="p-6">
        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="text-left bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-gray-600 text-sm font-semibold">Ad Soyad</th>
                            <th class="px-4 py-3 text-gray-600 text-sm font-semibold">E-posta</th>
                            <th class="px-4 py-3 text-gray-600 text-sm font-semibold">Rol</th>
                            <th class="px-4 py-3 text-gray-600 text-sm font-semibold">Kayıt Tarihi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                @if($user->isAdmin())
                                    <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">Admin</span>
                                @else
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Üye</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-500">{{ $user->created_at->format('d.m.Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-8 text-center text-gray-500">
                <p>Henüz kullanıcı bulunmamaktadır.</p>
            </div>
        @endif
    </div>
</div>
@endsection 