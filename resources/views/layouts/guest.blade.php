<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <script>
            const savedTheme = localStorage.getItem('theme');

            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script>
                window.tailwind = {
                    config: {
                        darkMode: 'class',
                    },
                };
            </script>
            <script src="https://cdn.tailwindcss.com"></script>
            <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @endif
    </head>
    <body class="font-sans text-slate-900 antialiased dark:text-slate-100">
        <div class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
            <div class="mx-auto flex w-full max-w-6xl justify-end px-6 py-5">
                <button
                    type="button"
                    class="inline-flex h-10 items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800 dark:focus:ring-offset-slate-950"
                    onclick="toggleTheme()"
                    aria-label="Toggle dark mode"
                >
                    <span data-theme-label>Light</span>
                </button>
            </div>

            <div class="flex min-h-[calc(100vh-92px)] items-center justify-center px-6 pb-12">
                {{ $slot }}
            </div>
        </div>

        <script>
            function toggleTheme() {
                const html = document.documentElement;
                const isDark = html.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');

                document.querySelectorAll('[data-theme-label]').forEach((el) => {
                    el.textContent = isDark ? 'Dark' : 'Light';
                });
            }

            document.addEventListener('DOMContentLoaded', () => {
                const isDark = document.documentElement.classList.contains('dark');
                document.querySelectorAll('[data-theme-label]').forEach((el) => {
                    el.textContent = isDark ? 'Dark' : 'Light';
                });
            });
        </script>
    </body>
</html>
