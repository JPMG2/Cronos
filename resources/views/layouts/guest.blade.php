<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
<div class="flex items-center min-h-screen p-4 bg-gradient-to-br from-blue-50 to-slate-100 lg:justify-center">
    <div
        class="flex flex-col overflow-hidden bg-gradient-to-r from-blue-100 to-blue-50 backdrop-blur-sm shadow-lg ring-1 ring-blue-200 rounded-xl max md:flex-row md:flex-1 lg:max-w-screen-md transition-all duration-300 hover:shadow-2xl hover:ring-blue-300"
    >
        <div
            class="p-6 py-8 text-slate-700 bg-gradient-to-br from-blue-100 via-blue-200 to-blue-300 md:w-80 md:flex-shrink-0 md:flex md:flex-col md:items-center md:justify-evenly shadow-inner"
        >
            <div
                class="my-3 text-4xl font-bold tracking-wider text-center transform transition-transform duration-300 hover:scale-105">
                <img src="{{asset('img/logoc2.png')}}" alt="Cronos Logo"
                     class="w-40 h-30 mx-auto object-contain z-20 drop-shadow-lg">
            </div>
            <p class="mt-6 text-lg font-bold text-center text-slate-700 md:mt-0 drop-shadow-md tracking-wide leading-relaxed">
                Gestionamos el tiempo.
            </p>

            <p class="mt-6 text-sm text-center text-slate-500 drop-shadow-sm">
                Copyrigh {{config('app.name')}} - {{date('Y')}} - V .{{config('app.version')}}
                <br>
                Todos los derechos reservados
            </p>

        </div>
        <div class="p-6 bg-white md:flex-1 shadow-inner">
            <h3 class="my-4 text-2xl font-semibold text-slate-700 drop-shadow-sm">Bienvenido</h3>
            <div class="transition-all duration-300">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
</body>
</html>
