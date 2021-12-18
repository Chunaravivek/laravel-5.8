<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin Login</title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- basic styles -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
        <script src="<?php echo BASE_PATH ?>plugins/jquery/jquery.min.js"></script>
        <link href="<?php echo BASE_PATH ?>css/app.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo BASE_PATH ?>plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?php echo BASE_PATH ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo BASE_PATH ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <link rel="stylesheet" href="<?php echo BASE_PATH ?>dist/css/adminlte.min.css">
    </head>

    <body class="login-page">

        @yield('content')
        
        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo BASE_PATH ?>plugins/jquery/jquery.js'>" + "<" + "/script>");
        </script>
        <script src="<?php echo BASE_PATH ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASE_PATH ?>plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="<?php echo BASE_PATH ?>dist/js/adminlte.min.js"></script>
    </body>
</html>