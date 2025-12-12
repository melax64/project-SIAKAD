<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @yield('content')
    </div>

    <script>
        // Apply dark mode on page load based on localStorage
        document.addEventListener("DOMContentLoaded", () => {
            const html = document.documentElement;
            const themeToggleBtn = document.getElementById('theme-toggle');

            // Atur mode awal dari localStorage
            if (
                localStorage.theme === 'dark' ||
                (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
            ) {
                html.classList.add('dark');
                if (themeToggleBtn) themeToggleBtn.textContent = '☀️';
            } else {
                html.classList.remove('dark');
                if (themeToggleBtn) themeToggleBtn.textContent = '🌙';
            }

            // Event tombol (jika ada)
            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', () => {
                    if (html.classList.contains('dark')) {
                        html.classList.remove('dark');
                        localStorage.theme = 'light';
                        themeToggleBtn.textContent = '🌙';
                    } else {
                        html.classList.add('dark');
                        localStorage.theme = 'dark';
                        themeToggleBtn.textContent = '☀️';
                    }
                });
            }
        });
    </script>

</body>

</html>
