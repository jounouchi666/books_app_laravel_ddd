<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.display_name', config('app.name', 'BooksApp')) }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
            <div class="flex-grow flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
                <div class="w-full sm:max-w-md">
                    <div class="w-full flex flex-col items-center">
                        <div class="mb-3 p-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-800/50 shadow-sm select-none">
                            <x-application-logo />
                        </div>
                        <h1 class="text-2xl font-light tracking-widest text-gray-800 dark:text-gray-200 font-serif">
                            {{ config('app.display_name', config('app.name', 'BooksApp')) }}
                        </h1>
                        <div class="mt-1 h-0.5 w-8 bg-gray-300 dark:bg-gray-600"></div>
                    </div>

                    <div class="mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <footer class="w-full bg-white dark:bg-gray-800 shadow">
                @include('layouts.footer')
            </footer>
        </div>
    </body>
</html>
