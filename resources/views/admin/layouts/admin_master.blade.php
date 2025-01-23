<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('icon-48x48.png') }}" />

    <link rel="canonical" href="https://demo.adminkit.io/dashboard-ecommerce.html" />

    <title>@yield("title_page","Home") | {{ config('setting.prefix_title') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Choose your prefered color scheme -->
    <!-- <link href="css/light.css" rel="stylesheet"> -->
    <!-- <link href="css/dark.css" rel="stylesheet"> -->

    <!-- BEGIN SETTINGS -->
    <!-- Remove this after purchasing -->
    <link class="js-stylesheet" href="/static/light.css" rel="stylesheet">
    <script src="/static/settings.js"></script>
    <style>
        body {
            opacity: 0;
        }
    </style>
</head>
<!--
  HOW TO USE:
  data-theme: default (default), dark, light, colored
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-layout: default (default), compact
-->

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">
    @include("admin.layouts.include._inc_adm_sidebar")

    <div class="main">
        @include("admin.layouts.include._inc_adm_navbar")
        @yield("content")
        @include("admin.layouts.include._inc_adm_footer")
    </div>
</div>

<script src="/static/app.js"></script>
@if(session('success') || session('danger'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            window.notyf.open({
                type: "{{ session('success') ? 'success' : 'danger' }}",
                message: "{{ session('success') ?? session('danger') }}",
                duration: 10000,
                ripple: true,
                dismissible: false,
                position: {
                    x: "right",
                    y: "bottom"
                }
            });
        });
    </script>
@endif
@yield('script')
</body>

</html>