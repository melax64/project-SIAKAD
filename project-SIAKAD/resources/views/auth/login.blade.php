@extends('layouts.app')

@section('title', 'Login - SIAKAD')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Back Button -->
        <a href="{{ route('landing') }}" 
           class="flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            Kembali
        </a>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <!-- Logo -->
            <div class="flex items-center justify-center mb-6">
                <div class="bg-blue-100 w-16 h-16 rounded-xl flex items-center justify-center">
                    <i data-lucide="graduation-cap" class="w-8 h-8 text-blue-600"></i>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-center text-gray-900 mb-2">
                Login {{ ucfirst($role ?? 'User') }}
            </h2>
            <p class="text-center text-gray-600 mb-8">
                Masukkan kredensial Anda untuk melanjutkan
            </p>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="role" value="{{ $role ?? 'mahasiswa' }}">

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        @if($role === 'mahasiswa')
                            NIM
                        @else
                            Email
                        @endif
                    </label>
                    <input 
                        type="text" 
                        id="email" 
                        name="email" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="@if($role === 'mahasiswa') Masukkan NIM @else Masukkan email @endif"
                        value="{{ old('email') }}"
                        required
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Masukkan password"
                        required
                    >
                </div>

                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="log-in" class="w-5 h-5"></i>
                    Login
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="#" class="text-blue-600 hover:text-blue-700 text-sm">
                    Lupa password?
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
