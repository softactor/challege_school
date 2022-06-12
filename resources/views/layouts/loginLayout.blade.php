<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <meta name="robots" content="" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="Registro Asia - Admin Dashboard" />
        <meta property="og:title" content="Registro Asia - Admin Dashboard" />
        <meta property="og:description" content="Registro Asia - Admin Dashboard" />
        <meta property="og:image" content="https://registella.asia//xhtml/social-image.png" />
        <meta name="format-detection" content="telephone=no">
        <title>{{ config('app.name', 'Registro Namebadge') }}</title>
        <link rel="shortcut icon" type="image/png" href="<?php echo asset('public/image/registro_Logo-PNG.png') ?>"/>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo asset('theme/images/favi.png') ?>">
        <link href="<?php echo asset('public/theme/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') ?>" rel="stylesheet">
        <link href="<?php echo asset('public/theme/css/style.css') ?>" rel="stylesheet">

    </head>

    <body class="vh-100">
        <div class="authincation h-100">
            <div class="container h-100">            

                @yield('content')

            </div>
        </div>


        <!--**********************************
            Scripts
        ***********************************-->
        <!-- Required vendors -->
        <script src="<?php echo asset('public/theme/vendor/global/global.min.js') ?>"></script>
        <script src="<?php echo asset('public/theme/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') ?>"></script>
        <script src="<?php echo asset('public/theme/js/custom.min.js') ?>"></script>
        <script src="<?php echo asset('public/theme/js/deznav-init.js') ?>"></script>


    </body>
</html>