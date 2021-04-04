<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        {{-- <x-jet-banner /> --}}
        
        <div>
            @livewire('navigation-menu')
        </div>

        {{-- Page Header --}}
        <div class="bg-white shadow">
            <div class="max-w-7xl my-auto py-6 px-4 sm:px-6 lg:px-8">
                {{$header}}
            </div>
        </div>

        {{-- Page Content --}}
        <div class="bg-gray-100 min-h-screen h-full py-6 px-4 sm:px-6 lg:px-8">
            {{$slot}}
        </div>
        <div class="inset-0">
            <x-footer></x-footer>
        </div>
        @stack('modals')

        @livewireScripts
    </body>
</html>
