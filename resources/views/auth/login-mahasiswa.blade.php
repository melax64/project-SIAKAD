@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-120px)] px-4 py-8">
    <div class="w-full max-w-md">

        <!-- Login Card -->
        <div class="bg-white rounded-[28px] shadow-2xl p-10">

            <!-- Logo & Icon -->
            <div class="flex flex-col items-center mb-8">
                <img src="{{ asset('images/mahasiswa.png') }}" class="w-14 h-14" alt="Logo">

                <div class="text-center">
                    <h1 class="text-[#0b1a34] mb-2">Login Mahasiswa</h1>
                    <p class="text-gray-500">Sistem Informasi Akademik</p>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('login.mahasiswa') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Email Input --}}
                <div>
                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        {{-- Mail Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 4h16v16H4z" stroke="none"/>
                            <path d="M4 4l8 8 8-8" stroke-width="2"/>
                        </svg>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:outline-none
                                   focus:ring-2 focus:ring-[#2563EB] bg-gray-50 hover:bg-white transition-all"
                            placeholder="mahasiswa@student.university.ac.id"
                            required
                            autofocus
                        />
                    </div>
                </div>

                {{-- Password Input --}}
                <div>
                    <label for="password" class="block text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        {{-- Lock Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 17a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                            <path d="M6 9V7a6 6 0 1 1 12 0v2" />
                            <rect x="4" y="9" width="16" height="12" rx="2" />
                        </svg>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="w-full pl-12 pr-12 py-3.5 border border-gray-200 rounded-xl focus:outline-none
                                   focus:ring-2 focus:ring-[#2563EB] bg-gray-50 hover:bg-white transition-all"
                            placeholder="••••••••"
                            required
                        />
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center cursor-pointer">
                        <input
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 text-[#2563EB] border-gray-300 rounded focus:ring-[#2563EB]"
                        />
                        <span class="ml-2 text-gray-600">Ingat Saya</span>
                    </label>

                    <a href="#" class="text-[#2563EB] hover:text-[#1d4ed8] transition-colors">
                        Lupa Password?
                    </a>
                </div>

                {{-- Login Button --}}
                <button type="submit"
                    class="w-full bg-[#2563EB] hover:bg-[#1d4ed8] text-white py-3.5 rounded-xl shadow-lg
                           hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                    Login
                </button>
            </form>

            {{-- Footer --}}
            <div class="mt-8 text-center">
                <p class="text-gray-500">© 2025 SIAKAD Universitas</p>
            </div>
        </div>

    </div>
</div>
@endsection
