<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Welcome')</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> --}}
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 text-gray-800">
    <main class="min-h-screen flex items-center justify-center p-4">
        @yield('content')
    </main>
</body>
</html>
