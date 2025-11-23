<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="flex items-center justify-center min-h-[calc(100vh-120px)] px-4 py-8">
        <div class="w-full max-w-md">

            <div class="bg-white rounded-[28px] shadow-2xl p-10">

                <!-- Logo & Title -->
                <div class="flex flex-col items-center mb-8">
                    <img src="{{ asset('images/admin.png') }}" class="w-14 h-14" alt="Logo">

                    <div class="text-center">
                        <h1 class="text-[#0b1a34] mb-2 text-2xl font-semibold">Login Admin</h1>
                        <p class="text-gray-500">Sistem Informasi Akademik</p>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('login.admin') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 12H8m8 0l-4-4m4 4l-4 4m4-4H8m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <input type="email" name="email" class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#2563EB] bg-gray-50 hover:bg-white" placeholder="admin@university.ac.id" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 11c1.105 0 2 .672 2 1.5S13.105 14 12 14s-2-.672-2-1.5S10.895 11 12 11zm0 0V8a4 4 0 10-4 4h8a4 4 0 10-4-4v3z" />
                            </svg>

                            <input type="password" name="password" class="w-full pl-12 pr-12 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#2563EB] bg-gray-50 hover:bg-white" placeholder="••••••••" required>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-[#2563EB] border-gray-300 rounded">
                            <span class="ml-2 text-gray-600">Ingat Saya</span>
                        </label>

                        <a class="text-[#2563EB] hover:text-[#1d4ed8]" href="#">Lupa Password?</a>
                    </div>

                    <!-- Button -->
                    <button type="submit" class="w-full bg-[#2563EB] hover:bg-[#1d4ed8] text-white py-3.5 rounded-xl shadow-lg hover:shadow-xl transition">
                        Login
                    </button>

                </form>

                <div class="mt-8 text-center text-gray-500">
                    © 2025 SIAKAD Universitas
                </div>

            </div>

        </div>
    </div>

</body>

</html>
