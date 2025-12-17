<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        
        {{-- 🔥 MỒI CHO TAILWIND (Để nó nhận diện màu trong Model PHP) 🔥 --}}
        <div class="hidden text-purple-600 text-yellow-600 text-blue-600 text-gray-600 text-gray-900 font-extrabold font-bold font-medium bg-purple-100 bg-blue-100 bg-yellow-100 bg-gray-50 border-purple-200 border-blue-200 border-yellow-200 border-gray-200"></div>

        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
               {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>

    @stack('scripts')
    </body>
</html>