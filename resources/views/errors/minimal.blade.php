<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Error')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-9xl font-bold text-gray-800">@yield('code', 'Error')</h1>
        <p class="text-2xl font-light text-gray-600 mt-4">@yield('title', 'Oops! Something went wrong')</p>
        <br>
        {{-- <p class="text-gray-500 mt-4 mb-8">@yield('message', 'An unexpected error occurred.')</p> --}}
        <a href="{{ url('/') }}" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition duration-300">
            Go back to homepage
        </a>
    </div>
</body>
</html>
