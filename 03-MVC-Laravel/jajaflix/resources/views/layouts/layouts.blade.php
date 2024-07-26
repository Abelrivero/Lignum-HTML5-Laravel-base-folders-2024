<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Scripts -->
    <script src="{{asset('/scripts/jquery.js')}}"></script>
    
    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    <title>
        @yield('title')
    </title>

    <script src="{{'/bootstrap/js/bootstrap.bundle.js'}}"></script>

    @livewireStyles
</head>
<body class="p-3 mb-2 bg-dark bg-gradient text-white">
    <main class="h-100">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('/scripts/swal.js')}}"></script>
    @yield('scripts')
    @livewireScripts
</body>
</html>