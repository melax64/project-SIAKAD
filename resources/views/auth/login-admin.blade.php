@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-120px)] px-4 py-8">
    <div class="w-full max-w-md">

        <div class="bg-white dark:bg-gray-800 rounded-[28px] shadow-2xl p-10">
            <div class="flex flex-col items-center mb-8">
                {{-- Pastikan gambar ini ada, kalau tidak ada ganti alt text --}}
                <img src="{{ asset('images/admin.png') }}" class="w-14 h-14" alt="Admin Icon" onerror="this.style.display='none'">

                <div class="text-center mt-2">
                    <h1 class="text-2xl font-bold text-[#0b1a34] dark:text-[#FFFF] mb-2">Login Admin</h1>
                    <p class="text-gray-500">Sistem Informasi Akademik</p>
                </div>
            </div>

            <!-- Menampilkan Error Global (Misal: CSRF Token mismatch) -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                    <p class="font-bold">Login Gagal!</p>
                    <ul class="list-disc ml-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.admin') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Input Email -->
                <div>
                    <label for="email" class="block text-gray-700 dark:text-[#FFFF] mb-2 font-medium">Email</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 4h16v16H4z" stroke="none"/>
                            <path d="M4 4l8 8 8-8" stroke-width="2"/>
                        </svg>

                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            class="w-full pl-12 pr-4 py-3.5 border @error('email') border-red-500 @else border-gray-200 @enderror rounded-xl
                            focus:ring-2 focus:ring-[#2563EB] bg-gray-50 dark:bg-gray-100 hover:bg-white transition-all"
                            placeholder="admin@siakad.com" required autofocus />
                    </div>
                    <!-- PESAN ERROR EMAIL -->
                    @error('email')
                        <p class="text-red-500 text-sm mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Password -->
                <div>
                    <label for="password" class="block text-gray-700 dark:text-[#FFFF] mb-2 font-medium">Password</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 17a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                            <path d="M6 9V7a6 6 0 1 1 12 0v2" />
                            <rect x="4" y="9" width="16" height="12" rx="2" />
                        </svg>

                        <input id="password" type="password" name="password"
                            class="w-full pl-12 pr-12 py-3.5 border border-gray-200 rounded-xl
                            focus:ring-2 focus:ring-[#2563EB] bg-gray-50 dark:bg-gray-100 hover:bg-white transition-all"
                            placeholder="••••••••" required />
                    </div>
                     <!-- PESAN ERROR PASSWORD -->
                     @error('password')
                        <p class="text-red-500 text-sm mt-1 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-[#2563EB] hover:bg-[#1d4ed8] text-white py-3.5 rounded-xl shadow-lg
                    hover:shadow-xl transition-all transform hover:-translate-y-0.5 font-bold tracking-wide">
                    Login Masuk
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-gray-500 text-sm">© 2025 SIAKAD Universitas</p>
            </div>
        </div>

    </div>
</div>
@endsection