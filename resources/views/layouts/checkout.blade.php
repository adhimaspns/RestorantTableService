<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSS -->
        @stack('prepend-styles')
        @include('includes.styles')

        <title>@yield('title-page')</title>
    </head>
    <body>

        <!-- Navbar -->
        @include('includes.navbar_checkout')

        <!-- Main Content -->
        @yield('main-content')

        <!-- SweetAlert -->
        @include('sweetalert::alert')

        <!-- Js -->
        @stack('prepend-scripts')
        @include('includes.scripts')
    </body>
</html>