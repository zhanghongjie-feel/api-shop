
<html>

<head>
    <script src="{{asset('js/jquery.min.js?v=2.1.4')}}"></script>
    <script src="{{asset('js/bootstrap.min.js?v=3.3.6')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>@yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css?v=4.1.0" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
</head>







<body class="fixed-sidebar full-height-layout gray-bg">


   
        <div class="container" style="margin-top:60px;">
            @yield('content')
        </div>

<!-- 全局js -->

<!-- 自定义js -->
{{--<script src="js/hAdmin.js?v=4.1.0"></script>--}}
{{--<script type="text/javascript" src="js/index.js"></script>--}}





