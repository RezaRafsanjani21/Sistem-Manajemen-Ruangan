@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-blue-600">Sistem Manajemen Ruangan</h1>
                </div>
                <div class="flex items-center space-x-8">
                    <span class="text-gray-700">Halo, <strong>{{ Auth::user()?->NAMA_USER ?? 'User' }}</strong></span>
                    <a href="{{ route('peminjaman.index') }}" class="text-gray-700 hover:text-blue-600 font-medium text-sm">Peminjaman Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-blue-600 font-medium text-sm">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-12">
            <h2 class="text-4xl font-bold text-gray-900">Dashboard</h2>
            <p class="text-gray-600 mt-2">Selamat datang di sistem manajemen ruangan</p>
        </div>

        <!-- Quick Action Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Buat Peminjaman -->
            <a href="{{ route('peminjaman.create') }}" class="bg-blue-500 hover:bg-blue-600 transition rounded-lg shadow-md p-6 text-white">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-white">
                                <span class="text-3xl font-bold text-blue-500">+</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium">Buat Peminjaman</h3>
                        <p class="text-blue-100 text-sm mt-1">Ajukan peminjaman baru</p>
                    </div>
                </div>
            </a>

            <!-- Lihat Peminjaman -->
            <a href="{{ route('peminjaman.index') }}" class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-6 border-t-4 border-gray-300">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Lihat Peminjaman</h3>
                        <p class="text-gray-600 text-sm mt-1">Riwayat peminjaman Anda</p>
                    </div>
                </div>
            </a>

            <!-- Info -->
            <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-gray-300">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Info</h3>
                        <p class="text-gray-600 text-sm mt-1">Bantuan & panduan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-8">Statistik Peminjaman Anda</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Total Peminjaman -->
                <div class="bg-blue-50 rounded-lg p-6 border-l-4 border-blue-500">
                    <p class="text-gray-600 font-medium text-sm mb-2">Total Peminjaman</p>
                    <p class="text-4xl font-bold text-blue-600">{{ $totalPeminjaman }}</p>
                </div>

                <!-- Menunggu -->
                <div class="bg-yellow-50 rounded-lg p-6 border-l-4 border-yellow-500">
                    <p class="text-gray-600 font-medium text-sm mb-2">Menunggu</p>
                    <p class="text-4xl font-bold text-yellow-600">{{ $menunggu }}</p>
                </div>

                <!-- Disetujui -->
                <div class="bg-green-50 rounded-lg p-6 border-l-4 border-green-500">
                    <p class="text-gray-600 font-medium text-sm mb-2">Disetujui</p>
                    <p class="text-4xl font-bold text-green-600">{{ $disetujui }}</p>
                </div>

                <!-- Selesai -->
                <div class="bg-gray-100 rounded-lg p-6 border-l-4 border-gray-400">
                    <p class="text-gray-600 font-medium text-sm mb-2">Selesai</p>
                    <p class="text-4xl font-bold text-gray-700">{{ $selesai }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
