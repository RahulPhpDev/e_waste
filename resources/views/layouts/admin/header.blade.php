<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
     E-Waste  @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <link href ={{ URL::asset('admin-assets/css/vendors.min.css') }} rel="stylesheet" />
    <link href ={{ URL::asset('admin-assets/css/materialize.css') }} rel="stylesheet" />
    <link href ={{ URL::asset('admin-assets/css/style.css') }} rel="stylesheet" />
    <link href ={{ URL::asset('admin-assets/css/custom.css') }} rel="stylesheet" />
    <link href ={{ URL::asset('admin-assets/css/form-select2.css') }} rel="stylesheet" />

    <script src ="{{ URL::asset('admin-assets/js/alpine-101.js') }}"/></script>

    <script src ="{{ URL::asset('admin-assets/js/vendors.min.js') }}"/></script>

<script src="{{ URL::asset('admin-assets/js/select2.full.min.js') }}"></script>


</head>

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
<meta name="csrf-token" content="{{ csrf_token() }}" />


