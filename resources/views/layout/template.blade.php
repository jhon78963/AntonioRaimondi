<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ secure_asset('plantilla/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    @yield('title')

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

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    @yield('css')

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ secure_asset('plantilla/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ secure_asset('plantilla/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
        <div class="layout-container">
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Sidebar container -->
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasStart"
                    aria-labelledby="offcanvasStartLabel">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasStartLabel" class="offcanvas-title">Offcanvas Start
                        </h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body my-auto mx-0 flex-grow-0">
                        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                            <div class="app-brand demo">
                                <a href="{{ route('bienvenido.index') }}" class="app-brand-link">
                                    <img src="{{ secure_asset('loginn/images/icono.png') }}" alt=""
                                        width="25%">
                                    <div class="row">
                                        <span class="app-brand-text demo menu-text fw-bolder ms-2">A. Raimondi</span>
                                    </div>

                                </a>
                            </div>

                            <div class="menu-inner-shadow"></div>

                            <ul class="menu-inner py-1">
                                <!-- Dashboard -->
                                <li class="menu-item">
                                    <a href="{{ route('bienvenido.index') }}" class="menu-link">
                                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                                        <div data-i18n="Analytics">Dashboard</div>
                                    </a>
                                </li>

                                <!-- Layouts -->
                                <li class="menu-item">
                                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                                        <i class="menu-icon tf-icons bx bx-layout"></i>
                                        <div data-i18n="Layouts">Administración</div>
                                    </a>

                                    <ul class="menu-sub">
                                        @can('permission.index')
                                            <li class="menu-item">
                                                <a href="{{ route('permissions.index') }}" class="menu-link">
                                                    <div data-i18n="Permisos">Permisos</div>
                                                </a>
                                            </li>
                                        @endcan

                                        @can('roles.index')
                                            <li class="menu-item">
                                                <a href="{{ route('roles.index') }}" class="menu-link">
                                                    <div data-i18n="Roles">Roles</div>
                                                </a>
                                            </li>
                                        @endcan

                                        @can('users.index')
                                            <li class="menu-item">
                                                <a href="{{ route('users.index') }}" class="menu-link">
                                                    <div data-i18n="Usuarios">Usuarios</div>
                                                </a>
                                            </li>
                                        @endcan

                                    </ul>
                                </li>

                                <li class="menu-item">
                                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                                        <i class="menu-icon tf-icons bx bx-layout"></i>
                                        <div data-i18n="Layouts">Entidades</div>
                                    </a>

                                    <ul class="menu-sub">
                                        <li class="menu-item">
                                            <a href="{{ route('roles.index') }}" class="menu-link">
                                                <div data-i18n="Roles">Docentes</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{ route('users.index') }}" class="menu-link">
                                                <div data-i18n="Usuarios">Alumnos</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{ route('permissions.index') }}" class="menu-link">
                                                <div data-i18n="Permisos">Cursos</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">

                                <button class="btn btn-info" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasStart" aria-controls="offcanvasStart">
                                    <i class="bx bx-menu bx-sm"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">


                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ auth()->user()->perfil->upro_image }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ auth()->user()->perfil->upro_image }}" alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span
                                                        class="fw-semibold d-block">{{ auth()->user()->user_name }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profiles.index') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">Mi Perfíl</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('login.cerrarSesion') }}">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Salir</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a href="#" class="footer-link fw-bolder">ZeroGRUPS</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ secure_asset('plantilla/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ secure_asset('plantilla/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ secure_asset('plantilla/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ secure_asset('plantilla/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ secure_asset('plantilla/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ secure_asset('plantilla/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ secure_asset('plantilla/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ secure_asset('plantilla/assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ secure_asset('plantilla/assets/js/pages-account-settings-account.js') }}"></script>

    <!-- Toastr JS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    @yield('js')
</body>

</html>
