@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Detail Peminjaman Ruangan</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informasi Peminjaman -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">ID Peminjaman</label>
                    <p class="mt-1 text-lg">{{ $peminjaman->ID_PEMINJAMAN }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <p class="mt-1">
                        <span class="px-3 py-1 rounded-full text-sm 
                            @if($peminjaman->STATUS === 'Disetujui') bg-green-100 text-green-800
                            @elseif($peminjaman->STATUS === 'Ditolak') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ $peminjaman->STATUS ?? 'Pending' }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Informasi Kegiatan -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                    <p class="mt-1 text-lg">{{ $peminjaman->kegiatan?->NAMA_KEGIATAN ?? '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Penanggung Jawab</label>
                    <p class="mt-1">{{ $peminjaman->kegiatan?->PENANGGUNG_JAWAB ?? '-' }}</p>
                </div>

                @if($peminjaman->kegiatan?->KETERANGAN)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <p class="mt-1">{{ $peminjaman->kegiatan->KETERANGAN }}</p>
                </div>
                @endif
            </div>

            <!-- Informasi Ruangan -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                    <p class="mt-1 text-lg">{{ $peminjaman->ruangan?->NAMA_RUANGAN ?? '-' }}</p>
                </div>

                @if($peminjaman->ruangan)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                    <p class="mt-1">{{ $peminjaman->ruangan->KAPASITAS ?? '-' }} orang</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <p class="mt-1">{{ $peminjaman->ruangan->LOKASI ?? '-' }}</p>
                </div>

                @if($peminjaman->ruangan->FASILITAS)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fasilitas</label>
                    <p class="mt-1">{{ $peminjaman->ruangan->FASILITAS }}</p>
                </div>
                @endif
                @endif
            </div>

            <!-- Informasi Pemohon -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Pemohon</label>
                    <p class="mt-1 text-lg">{{ $peminjaman->user?->NAMA_USER ?? $peminjaman->pengguna?->NAMA_USER ?? '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Username</label>
                    <p class="mt-1">{{ $peminjaman->user?->USERNAME ?? $peminjaman->pengguna?->USERNAME ?? '-' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Role</label>
                    <p class="mt-1">{{ $peminjaman->user?->ROLE ?? $peminjaman->pengguna?->ROLE ?? '-' }}</p>
                </div>
            </div>

            <!-- Informasi Waktu -->
            <div class="space-y-4 md:col-span-2">
                @if($peminjaman->waktu)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <p class="mt-1">{{ $peminjaman->waktu->TANGGAL ? \Carbon\Carbon::parse($peminjaman->waktu->TANGGAL)->format('d M Y') : '-' }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                        <p class="mt-1">{{ $peminjaman->waktu->JAM_MULAI ? \Carbon\Carbon::parse($peminjaman->waktu->JAM_MULAI)->format('H:i') : '-' }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                        <p class="mt-1">{{ $peminjaman->waktu->JAM_SELESAI ? \Carbon\Carbon::parse($peminjaman->waktu->JAM_SELESAI)->format('H:i') : '-' }}</p>
                    </div>
                </div>
                @else
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jadwal</label>
                    <p class="mt-1 text-gray-500">Data waktu tidak tersedia</p>
                </div>
                @endif
            </div>
        </div>

        <div class="mt-8 flex gap-4">
            <a href="{{ route('peminjaman.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
