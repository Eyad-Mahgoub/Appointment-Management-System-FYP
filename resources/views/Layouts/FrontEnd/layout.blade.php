<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        {{-- Custom CSS --}}
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
        {{-- BootStrap CSS CDN --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <title>@yield('title')</title>
    </head>
    <body class="{{ Route::currentRouteName() == 'frontend.loginpage' ? 'bg-heart-monitor' : 'bg-blue' }}">
        @include('Layouts.FrontEnd.navbar')
        <main>
            @yield('content')
        </main>

        {{-- Jquery CDN --}}
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        {{-- BootStrap CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        {{-- Sweet Alert CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- Sweet Alert CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- Custom JS --}}
        <script src="{{ asset('frontend/js/script.js') }}"></script>
        @if (session('error_message'))
        <script>
            Swal.fire({
                icon: 'error',
                title: "{{ session('error_message') }}",
            });
        </script>
        @endif
        @if (session('message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "{{ session('message') }}",
            });
        </script>
        @endif
        @yield('script')
    </body>
</html>
