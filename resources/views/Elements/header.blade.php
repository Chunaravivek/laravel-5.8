<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
        <!-- basic styles -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
        <link rel="stylesheet" href="<?php echo BASE_PATH; ?>css/style.css?d=<?php echo time(); ?>" >

        <script src="<?php echo BASE_PATH ?>plugins/jquery/jquery.min.js"></script>

        <link rel="stylesheet" href="<?php echo BASE_PATH ?>dist/css/adminlte.min.css">
        <link rel="stylesheet" href="<?php echo BASE_PATH ?>plugins/jquery-ui/jquery-ui.css" />
        <link rel="stylesheet" href="<?php echo BASE_PATH ?>plugins/jquery-ui/jquery-ui.theme.css" />
        <link rel="stylesheet" href="<?php echo BASE_PATH ?>plugins/fontawesome-free/css/all.min.css" />
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo BASE_PATH ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo BASE_PATH ?>plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.css" />
        <link rel="stylesheet" href="<?php echo BASE_PATH ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css" />

        <link rel="stylesheet" href="<?php echo BASE_PATH ?>plugins/jqvmap/jqvmap.min.css">
        <link rel="stylesheet" href="<?php echo BASE_PATH ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="<?php echo BASE_PATH ?>plugins/summernote/summernote-bs4.min.css">

        <script src="<?php echo BASE_PATH ?>plugins/bootstrap/js/bootstrap.bundle.js"></script>
        <script src="<?php echo BASE_PATH ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASE_PATH ?>plugins/jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo BASE_PATH ?>plugins/jquery-ui/jquery-ui.min.js"></script>
        
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="<?php echo BASE_PATH; ?>dist/img/PlayScraperLogo.png" alt="PlayScraperLogo" height="60" width="60">
            </div>
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                    </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
                    </li>
                </ul>
            </nav>
            @include('Elements.sidebar')



