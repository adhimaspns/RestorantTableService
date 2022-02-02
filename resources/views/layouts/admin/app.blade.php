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
        @include('includes.navbar')

        <!-- Main Content -->
        @yield('main-content')

        <!-- Js -->
        @include('includes.scripts')
    </body>
</html>