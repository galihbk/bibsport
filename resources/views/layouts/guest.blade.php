<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BIBSPORT</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ url('assets') }}/img/favicon.png" rel="icon">
    <link href="{{ url('assets') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="{{ url('assets-admin') }}/css/style.css" rel="stylesheet">
    <link href="{{ url('assets-admin') }}/vendor/fontawesome/css/all.min.css" rel="stylesheet" />
</head>

<body class="vh-100">

    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row h-100">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script src="{{ url('assets-admin') }}/vendor/global/global.min.js"></script>
    <script src="{{ url('assets-admin') }}/js/custom.min.js"></script>
    <script src="{{ url('assets-admin') }}/js/dlabnav-init.js"></script>

</body>

</html>