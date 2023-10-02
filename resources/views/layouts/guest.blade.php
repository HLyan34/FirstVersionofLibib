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
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/12f3b80f60.js" crossorigin="anonymous"></script>

        <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/css/admin.css',  'resources/js/app.js','resources/js/admin.js'])
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900" style="background-color: #212529;">
            <div><a class="navbar-brand text-white" href="{{route('home')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="165.5" height="32" viewBox="0 0 512 99"><path d="M277.453 29.62c18.816 0 33.025 14.286 33.025 34.204c0 19.792-14.209 34.205-33.025 34.205s-33.025-14.413-33.025-34.205c0-19.918 14.21-34.204 33.025-34.204Zm204.98 0c16.93 0 26.537 10.878 29.188 21.756l-15.037 5.24c-1.515-5.371-5.436-10.874-13.772-10.874c-8.595 0-15.795 6.421-15.795 18.082c0 11.665 7.33 18.218 15.921 18.218c8.592 0 12.89-5.897 14.278-10.878l14.783 5.113c-2.78 10.743-12.509 21.752-29.06 21.752c-18.324 0-32.728-14.413-32.728-34.205c0-19.918 14.15-34.204 32.221-34.204Zm-314.471 0c19.847 0 27.224 11.555 27.224 24.553V85.95c0 3.413.382 8.01.764 10.241h-15.52c-.383-1.709-.637-5.254-.637-7.748c-3.181 5.123-9.163 9.585-18.45 9.585c-13.36 0-21.5-9.322-21.5-19.432c0-11.556 8.268-17.99 18.701-19.563l15.397-2.366c3.56-.526 4.705-2.362 4.705-4.593c0-4.597-3.435-8.405-10.56-8.405c-7.38 0-11.452 4.86-11.958 10.504l-15.015-3.282c1.019-10.11 10.051-21.272 26.849-21.272Zm60.21-16.925v19.099h12.523v15.328H228.17v26.762c0 5.589 2.53 7.406 7.338 7.406c2.023 0 4.3-.26 5.186-.52v14.29c-1.52.651-4.556 1.558-9.488 1.558c-12.147 0-19.735-7.402-19.735-19.743V47.122h-11.26V31.794h3.163c6.578 0 9.614-4.418 9.614-10.133v-8.966h15.182Zm163.907 17.262c11.702 0 22.892 7.206 22.892 24.5V96.25h-16.59V57.994c0-6.944-3.344-12.182-11.19-12.182c-7.332 0-11.706 5.763-11.706 12.707v37.73h-16.974V57.995c0-6.944-3.472-12.182-11.193-12.182c-7.457 0-11.831 5.632-11.831 12.707v37.73H318.38V31.794h16.337v7.859c3.472-6.288 11.573-9.695 18.518-9.695c8.616 0 15.564 3.8 18.776 10.744c5.018-7.859 11.706-10.744 20.067-10.744Zm49.701 1.779v64.177h-16.335V31.736h16.335ZM178.905 66.997l-13.749 2.294c-4.213.675-7.558 3.235-7.558 8.357c0 3.91 2.601 7.685 7.93 7.685c6.935 0 13.377-3.64 13.377-15.367v-2.969Zm98.548-21.861c-8.308 0-15.98 6.155-15.98 18.335c0 12.05 7.672 18.337 15.98 18.337c8.312 0 15.98-6.155 15.98-18.337c0-12.18-7.668-18.335-15.98-18.335ZM433.613 0c5.779 0 10.298 4.772 10.298 10.71c0 5.675-4.52 10.447-10.298 10.447c-5.654 0-10.298-4.772-10.298-10.448C423.315 4.772 427.959 0 433.613 0Z"/><path fill="#1E6EFA" d="M74.257 96.434H14.614C6.543 96.434 0 89.891 0 81.821c0-8.073 6.542-14.617 14.614-14.622l33.796-.017a15.54 15.54 0 0 1 13.473 7.781l12.374 21.471Z"/><path fill="#FF3C5A" d="M11.071 58.962L40.893 7.31C44.93.32 53.866-2.075 60.856 1.96c6.99 4.036 9.388 12.974 5.355 19.967L49.328 51.203a15.542 15.542 0 0 1-13.475 7.778l-24.782-.019Z"/><path fill="#FFC5CE" d="m75.208 22.978l29.821 51.653c4.036 6.99 1.641 15.927-5.349 19.963c-6.99 4.036-15.93 1.643-19.969-5.346L62.8 59.988a15.543 15.543 0 0 1 0-15.558l12.407-21.452Z"/></svg>
                    </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4  dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"  style="background-color: #333A40;" >
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
