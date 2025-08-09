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
<body class="font-sans text-gray-900 antialiased bg-gray-100">

    <div class="min-h-screen flex flex-col justify-center items-center px-4">

        <!-- Logo -->
        <div class="flex flex-col items-center mb-5">
            
            <h1 class="mt-2 text-lg sm:text-xl font-semibold text-gray-800 tracking-wide">
                {{ config('app.name', 'BUMDESmart') }}
            </h1>
        </div>
        <!-- End Logo -->

        <!-- Form Container -->
        <div class="w-full sm:max-w-md px-6 py-6 bg-white shadow-lg rounded-xl border border-gray-200">
            {{ $slot }}
        </div>
        <!-- End Form Container -->

    </div>

</body>
</html>
