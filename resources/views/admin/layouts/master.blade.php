<!DOCTYPE html>
<html lang="fa">

<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.head')
    @yield('css')
</head>
<body>
@yield('content')
@yield('script')
</body>
</html>
