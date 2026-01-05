@extends('layouts.app')

@section('title', 'Daftar Peminjaman - Sistem Manajemen Ruangan')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-600">Sistem Manajemen Ruangan</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    <a href="{{ route('peminjaman.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Peminjaman Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">Daftar Peminjaman</h1>
                    <p class="text-gray-600 mt-2">Kelola semua peminjaman ruangan Anda</p>
                </div>
                <a href="{{ route('peminjaman.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium">
                    ➕ Buat Peminjaman Baru
                </a>
            </div>
        </div>

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <p class="text-green-800">✓ {{ session('success') }}</p>
            </div>
        @endif

        <!-- Tabel Peminjaman -->
        @if ($peminjaman->count() > 0)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">ID</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Ruangan</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Kegiatan</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Tanggal</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $item)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $item->ID_PEMINJAMAN }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $item->ruangan?->NAMA_RUANGAN ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $item->kegiatan?->NAMA_KEGIATAN ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $item->waktu?->TANGGAL ? \Carbon\Carbon::parse($item->waktu->TANGGAL)->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $item->status_badge_class }}">
                                        {{ $item->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('peminjaman.show', $item->ID_PEMINJAMAN) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <p class="text-gray-500 text-lg">Anda belum membuat peminjaman ruangan apapun.</p>
                <a href="{{ route('peminjaman.create') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium">
                    Buat Peminjaman Sekarang
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
