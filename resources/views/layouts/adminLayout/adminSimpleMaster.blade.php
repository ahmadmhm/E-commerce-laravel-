<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/backend_css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/bootstrap-responsive.min.css')}}" />
    <link href="{{asset('fonts/backend_fonts/css/font-awesome.css')}}" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    @yield('css')
</head>

<body>

@yield('content')



</body>
<script src="{{asset('js/frontend_js/jquery-1.11.2.min.js')}}"></script>
<script src="{{asset('js/backend_js/jquery.min.js')}}"></script>
<script src="{{asset('js/backend_js/jquery.ui.custom.js')}}"></script>
<script src="{{asset('js/backend_js/bootstrap.min.js')}}"></script>
@yield('js')
@include('common.message')
@include('common.errors')
</html>
