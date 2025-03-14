<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Taibah Shop' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <style>
            @layer utilities {
                  /* Hide scrollbar for Chrome, Safari and Opera */
                  .no-scrollbar::-webkit-scrollbar {
                      display: none;
                  }
                 /* Hide scrollbar for IE, Edge and Firefox */
                  .no-scrollbar {
                      -ms-overflow-style: none;  /* IE and Edge */
                      scrollbar-width: none;  /* Firefox */
                }
              }
        </style>

        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body class="bg-slate-100 dark:bg-slate-700" >
        
        @livewire('partials.navbar')
        <main>
            {{ $slot }}
        </main>
        @livewire('partials.footer')
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <x-livewire-alert::scripts />
        
    </body>
</html> 
