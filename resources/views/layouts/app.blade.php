<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Cale le fond anime sur l'heure reelle, pour qu'il continue au meme
             endroit d'une page a l'autre au lieu de repartir de zero a chaque clic. --}}
        <script>
            document.documentElement.style.setProperty('--bde-bg-delay', '-' + ((Date.now() / 1000) % 18) + 's');
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100/40">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

    </body>
</html>
