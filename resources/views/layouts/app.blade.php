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

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f0fdf4; /* Latar belakang hijau muda */
        }
        .navbar {
            background-color: #198754 !important; /* Navbar hijau */
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .shadow-header {
            box-shadow: 0px 4px 6px rgba(0, 128, 0, 0.1); /* Bayangan hijau */
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <!-- Navbar -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-header py-3">
                <div class="container">
                    <h2 class="text-success fw-bold">{{ $header }}</h2>
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="container py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tempat untuk script tambahan dari setiap halaman -->
    @yield('scripts')

</body>
</html>
