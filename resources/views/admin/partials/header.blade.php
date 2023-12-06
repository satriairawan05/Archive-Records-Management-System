<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="title" content="Sistem Informasi Arsip Surat Dinas Perhubungan Kota Samarinda">
    <meta name="description" content="Sistem Informasi Arsip Surat Dinas Perhubungan Kota Samarinda">
    <meta name="keywords" content="Sistem Informasi, Laravel, Bootstrap, Aplikasi Surat">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="Deuwi Satriya Irawan">
    <title>{{ env('APP_NAME') }} </title>
    <!-- Favicon icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('images/site.webmanifest') }}">

    <!-- Focus Theme CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @stack('css')

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/dist/sweetalert2.min.css') }}">

    <style type="text/css">
        .horizontal {
            border: 1px solid black;
            height: 40px;
            margin: 0 10px;
        }

        #header {
            background-color: var(--dishub-color) !important;
        }
    </style>

</head>

<body>
