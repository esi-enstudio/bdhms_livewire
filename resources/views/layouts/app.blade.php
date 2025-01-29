<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title .' - '. env('APP_NAME') }}</title>

        <!-- Fonts -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="dark:bg-neutral-800 dark:text-white antialiased">

    <!-- ========== HEADER ========== -->
    @livewire('layouts.header')
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->

    <!-- Breadcrumb -->
    @livewire('layouts.breadcrumb')

    <!-- Sidebar -->
    @livewire('layouts.sidebar')
    <!-- End Sidebar -->

    <!-- Content -->
    <div class="w-full lg:ps-64">
        <div class="p-2 sm:p-4 space-y-4 sm:space-y-6">
            {{ $slot }}
        </div>
    </div>
    <!-- End Content -->
    <!-- ========== END MAIN CONTENT ========== -->

        @livewireScripts

    @stack('scripts')
    </body>
</html>
