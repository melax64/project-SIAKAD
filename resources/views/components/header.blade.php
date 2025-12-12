<header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-10">
    <div class="px-8 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <i data-lucide="graduation-cap" class="w-8 h-8 text-blue-600"></i>
                <div>
                    <span class="text-lg font-semibold text-blue-900 dark:text-white">SIAKAD Universitas</span>
                    <p class="text-sm text-gray-500">Portal {{ $userRole }}</p>
                </div>
            </div>

            <!-- Right Section -->
            <div class="flex items-center gap-4">
                <!-- Notifications -->
                <button class="relative p-2 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="bell" class="w-5 h-5 text-gray-600"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- User Info -->
                <div class="flex items-center gap-3 px-4 py-2 bg-gray-50 dark:bg-gray-900 rounded-lg">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center overflow-hidden">
                        @php
                            $roleImage = match (Auth::user()->role ?? 'mahasiswa') {
                                'admin' => 'images/admin.png',
                                'dosen' => 'images/dosen.png',
                                'mahasiswa' => 'images/mahasiswa.png',
                                default => 'images/mahasiswa.png',
                            };
                        @endphp
                        <img src="{{ asset($roleImage) }}" alt="Role Icon" class="w-full h-full object-cover">
                    </div>
                    <div class="hidden md:block">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $userName }}</p>
                        <p class="text-xs text-gray-500">{{ $userRole }}</p>
                    </div>
                </div>

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 px-4 py-2 bg-red-600 text-red-50 hover:bg-red-100 rounded-lg transition-colors font-medium text-sm">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
