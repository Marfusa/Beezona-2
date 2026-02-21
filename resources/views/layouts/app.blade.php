<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Beezona') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,900;1,900&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Примусово встановлюємо шрифт для масивних заголовків */
            .font-beezona {
                font-family: 'Montserrat', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-white text-gray-900">
        <div class="min-h-screen bg-white">
            {{-- Навігація Beezona --}}
            @include('layouts.navigation')

           
            <main class="font-beezona">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>