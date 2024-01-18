<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>
    @vite('resources/css/app.css')

    
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

    @livewireStyles
</head>
<body>

<div class="max-w-4xl mx-auto mt-5">
    <div class="px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-black">Livewire CRUD with Laravel 9 and Tailwind CSS</h1>
    </div>
</div>


@yield('home')


@livewireScripts
</body>
</html>