@extends('layouts.app')

@section('title', 'Login - Sistem Manajemen Ruangan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-400 to-blue-600 px-8 py-6">
                <h2 class="text-3xl font-bold text-white text-center">Login</h2>
                <p class="text-blue-100 text-center mt-2">Sistem Manajemen Ruangan</p>
            </div>

            <!-- Form -->
            <div class="px-8 py-8">
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="USERNAME" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                        <input 
                            id="USERNAME" 
                            name="USERNAME" 
                            type="text" 
                            required 
                            value="{{ old('USERNAME') }}"
                            class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="Masukkan username"
                        >
                    </div>

                    <div>
                        <label for="PASSWORD" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input 
                            id="PASSWORD" 
                            name="PASSWORD" 
                            type="password" 
                            required 
                            class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="Masukkan password"
                        >
                    </div>

                    <div>
                        <button 
                            type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200"
                        >
                            Login
                        </button>
                    </div>
                </form>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Atau</span>
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <a href="/" class="text-blue-500 hover:text-blue-600 text-sm font-medium">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Info -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Admin? 
                <a href="/admin" class="text-blue-500 hover:text-blue-600 font-medium">Login sebagai Admin</a>
            </p>
        </div>
    </div>
</div>
@endsection
