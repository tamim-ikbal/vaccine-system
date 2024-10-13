<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}"
      x-data="{
      darkMode: localStorage.getItem('darkMode')
      || localStorage.setItem('darkMode', 'system')}"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      x-bind:class="{'dark': darkMode === 'dark' || (darkMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)}"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Covid19') - {{ __('Vaccine System') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-800">
@include('layouts.partials.header')
<div class="py-4 md:py-6 lg:py-8 min-h-[80vh]">
    @section('content')
    @show
</div>
@include('layouts.partials.footer')
<x-toast />
@livewireScripts
@stack('scripts')
</body>
</html>
