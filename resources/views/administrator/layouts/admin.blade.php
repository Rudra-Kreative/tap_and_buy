<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @isset($title)
            {{ $title }}
        @endisset
    </title>

    <!-- CSS Links -->
    @include('administrator.inc.css_links')

    <!-- Custom CSS -->
    @yield('admin_css')
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        @include('administrator.inc.nav')

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">
                    {{ Config::get('app.name', 'Tap & Buy') }}
                </span>
            </a>

            <!-- sidebar -->
            @include('administrator.layouts.sidebar-nav')

        </aside>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    @yield('title')
                </div>
            </div>

            <!-- Dynamic content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>

        </div>

        <!-- Footer content -->
        @include('administrator.layouts.footer')
    </div>

    <!-- JS Links -->
    @include('administrator.inc.js_links')

    <!-- sweetalert JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.19/dist/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <!-- Custom JS -->
    @yield('admin_js')
</body>

</html>
