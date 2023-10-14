<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if(session('toast:success'))
            <meta name="toasts[success]" content="{{ session('toast:success') }}">
        @endif

        @if(session('toast:error'))
            <meta name="toasts[error]" content="{{ session('toast:error') }}">
        @else
            @if($errors->any())
                <meta name="toasts[error]" content="Что-то пошло не так, поля для ввода не прошли проверку.">
            @endif
        @endif

        <title>@yield('title', '-') | {{ config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">

        @vite(['resources/js/app.js'])

        @stack('up')
    </head>
    <body>
        @isset($sidebar)
            {{ $sidebar }}
        @else
            @include('layouts.sidebar')
        @endisset

        <main class="main">
            @include('layouts.navigation')

            <div class="container-fluid">
                <div class="p-4">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </body>
</html>
