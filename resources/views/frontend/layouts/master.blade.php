<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/ionicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/AdminLTE.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/_all-skins.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/frontend.css') !!}">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="skin-blue hold-transition sidebar-mini">
<div class="wrapper">

    @include('frontend.layouts.header')

    @include('frontend.layouts.sidebar')

    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

    @include('frontend.layouts.footer')
    <div class="control-sidebar-bg"></div>
</div>
<script src="{!! asset('js/jquery.min.js') !!}"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('js/adminlte.min.js') !!}"></script>
</body>
</html>
