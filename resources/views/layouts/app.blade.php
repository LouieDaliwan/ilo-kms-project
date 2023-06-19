<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased w-full">
        <div class="app">
            @include('navbar.main')
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </body>
</html>
