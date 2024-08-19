 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

     <!-- Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])
 </head>

 <body class="font-sans text-gray-900 antialiased">
     <nav class="bg-white border-b shadow border-gray-100">
         <!-- Logo -->
         <div class="flex items-center justify-center h-16">
             <a href="{{ route('dashboard') }}">
                 <x-application-logo class="block h-8 w-auto fill-current" />
             </a>
         </div>
     </nav>


     <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
         <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-2xl">
             <div class="flex justify-center mb-4">
                 <a href="/">
                     <img src="{{ asset('img/logo-fhci.png') }}" alt="Logo" class="h-20">
                 </a>
             </div>
             <h2 class="mt-6 mb-4 text-center text-lg font-bold text-red-500">
                 Selangkah Lebih Dekat Dengan Suksesmu
             </h2>
             {{ $slot }}
         </div>
     </div>
 </body>


 </html>
