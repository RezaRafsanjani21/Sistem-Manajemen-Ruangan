@extends('layouts.app')

@section('title', 'Detail Peminjaman - Sistem Manajemen Ruangan')

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
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <a href="{{ route('peminjaman.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Peminjaman</h1>
                    <p class="text-gray-600 mt-1">ID Peminjaman: #{{ $peminjaman->ID_PEMINJAMAN }}</p>
                </div>
                <div>
                    <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full {{ $peminjaman->status_badge_class }}">
                        {{ $peminjaman->status_label }}
                    </span>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Ruangan</dt>
                        <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $peminjaman->ruangan->NAMA_RUANGAN }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Lokasi</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $peminjaman->ruangan->LOKASI }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Kapasitas</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $peminjaman->ruangan->KAPASITAS }} orang</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Fasilitas</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $peminjaman->ruangan->FASILITAS }}</dd>
                    </div>

                    <div class="sm:col-span-2 border-t border-gray-200 pt-6">
                        <dt class="text-sm font-medium text-gray-500 mb-2">Kegiatan</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="font-semibold text-lg">{{ $peminjaman->kegiatan?->NAMA_KEGIATAN ?? '-' }}</p>
                                <p class="text-gray-600 mt-2"><strong>Penanggung Jawab:</strong> {{ $peminjaman->kegiatan?->PENANGGUNG_JAWAB ?? '-' }}</p>
                                @if($peminjaman->kegiatan?->KETERANGAN)
                                    <p class="text-gray-600 mt-2"><strong>Keterangan:</strong> {{ $peminjaman->kegiatan->KETERANGAN }}</p>
                                @endif

                            </div>
                        </dd>
                    </div>

                    <div class="sm:col-span-2 border-t border-gray-200 pt-6">
                        <dt class="text-sm font-medium text-gray-500 mb-2">Jadwal</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="font-semibold">{{ \Carbon\Carbon::parse($peminjaman->waktu->TANGGAL)->format('l, d F Y') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-semibold">
                                        {{ \Carbon\Carbon::parse($peminjaman->waktu->JAM_MULAI)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($peminjaman->waktu->JAM_SELESAI)->format('H:i') }} WIB
                                    </span>
                                </div>
                                <p class="text-gray-600 mt-2 text-xs">
                                    Durasi: {{ \Carbon\Carbon::parse($peminjaman->waktu->JAM_MULAI)->diffInHours(\Carbon\Carbon::parse($peminjaman->waktu->JAM_SELESAI)) }} jam
                                </p>
                            </div>
                        </dd>
                    </div>

                    <div class="sm:col-span-1 border-t border-gray-200 pt-6">
                        <dt class="text-sm font-medium text-gray-500">Pemohon</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $peminjaman->user->NAMA_USER }}</dd>
                    </div>

                    <div class="sm:col-span-1 border-t border-gray-200 pt-6">
                        <dt class="text-sm font-medium text-gray-500">Username</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $peminjaman->user->USERNAME }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
