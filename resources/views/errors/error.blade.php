<!DOCTYPE html>
<html lang="en" class="light-style" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ secure_asset('plantilla/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="loginn/images/icono.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ secure_asset('plantilla/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ secure_asset('plantilla/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ secure_asset('plantilla/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ secure_asset('plantilla/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ secure_asset('plantilla/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ secure_asset('plantilla/assets/vendor/css/pages/page-misc.css') }}" />
    <!-- Helpers -->
    <script src="{{ secure_asset('plantilla/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ secure_asset('plantilla/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <!-- Error -->
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h2 class="mb-2 mx-2">@yield('title_message')(</h2>
            <p class="mb-4 mx-2">@yield('body_message')</p>
            <a href="{{ route('bienvenido.index') }}" class="btn btn-primary">Regresar al Inicio</a>
            <div class="mt-3">
                @yield('image_message')
            </div>
        </div>
    </div>
    <!-- /Error -->

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ secure_asset('plantilla/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ secure_asset('plantilla/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ secure_asset('plantilla/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ secure_asset('plantilla/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ secure_asset('plantilla/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ secure_asset('plantilla/assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
