<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        @vite('resources/css/app.css')
        @livewireStyles
    </head>
    <body class="antialiased w-full">
        <div class="app">
            @include('navbar.main')
        </div>

        <main class="py-4 mt-10 w-[100%]">
            @yield('content')
        </main>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.js"></script>
        @livewireScripts
    </body>
</html>
