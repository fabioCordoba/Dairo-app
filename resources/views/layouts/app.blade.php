<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Admin - Dairo-App') }}</title>
        <link rel="shortcut icon" href="{!! asset('images/jpg/food.png')!!}" />

        <!-- Fonts -->

        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}" ></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        @livewireStyles
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                  <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Desarrollador <a href="https://www.linkedin.com/in/fabio-cordoba-5a8370113/" target="_blank">Fabio Cordoba</a> Ingeniero de Sistemas</span>
                  <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2022. Derechos reservados.</span>
                </div>
            </footer>
        </div>

        @stack('modals')

        <script src="{{ asset('js/toastr.min.js') }}"></script>
        <script src="{{ asset('js/helper.js') }}"></script>
        @livewireScripts
    </body>
</html>
