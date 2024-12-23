<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title', 'Home')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

    <body>
        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar layout-without-menu">
            <div class="layout-container">
                <!-- Layout container -->
                    <div class="layout-page">
                        <!-- Navbar -->
                            @include('app.navbar')
                        <!-- / Navbar -->

                        <!-- Content wrapper -->
                            <div class="content-wrapper">
                                <!-- Content -->

                                @if (session('success'))
                                    <div class="bs-toast toast fade show bg-success floating-alert" role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="toast-header">
                                            <i class="bx bx-bell me-2"></i>
                                            <div class="me-auto fw-semibold">{{ __('Well done!') }}</div>
                                            {{-- <small>11 mins ago</small> --}}
                                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                        </div>
                                        <div class="toast-body">
                                            {{ __(session('success')) }}
                                        </div>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="bs-toast toast fade show bg-danger floating-alert" role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="toast-header">
                                            <i class="bx bx-bell me-2"></i>
                                            <div class="me-auto fw-semibold">{{ __('Oh No!') }}</div>
                                            {{-- <small>11 mins ago</small> --}}
                                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                        </div>
                                        <div class="toast-body">
                                            {{ __(session('error')) }}
                                        </div>
                                    </div>
                                @endif

                                @if (session('info'))
                                    <div class="bs-toast toast fade show bg-info floating-alert" role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="toast-header">
                                            <i class="bx bx-bell me-2"></i>
                                            <div class="me-auto fw-semibold">{{ __('Oh No!') }}</div>
                                            {{-- <small>11 mins ago</small> --}}
                                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                        </div>
                                        <div class="toast-body">
                                            {{ __(session('info')) }}
                                        </div>
                                    </div>
                                @endif                                

                                <div class="container-fluid flex-grow-1 container-p-y">

                                    @yield('content')
                                    
                                </div>
                                <!-- / Content -->

                                <!-- Footer -->
                                    <footer class="content-footer footer bg-footer-theme">
                                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                                            <div class="mb-2 mb-md-0">
                                                ©
                                                <script>
                                                    document.write(new Date().getFullYear());
                                                </script>
                                                , made by
                                                <a href="#" target="_blank" class="footer-link fw-bolder">Pankaj Kumar</a>
                                            </div>

                                            {{-- <div>
                                            <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                                            <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                                            <a
                                                href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                                target="_blank"
                                                class="footer-link me-4"
                                                >Documentation</a
                                            >

                                            <a
                                                href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                                target="_blank"
                                                class="footer-link me-4"
                                                >Support</a
                                            >
                                            </div> --}}
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
        <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

        <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->

        <!-- Main JS -->
        <script src="{{ asset('assets/js/main.js') }}"></script>

        @yield('script')

        <script type="text/javascript">
            setTimeout(() => {
                $('.floating-alert').removeClass('show');
                $('.floating-alert').addClass('hide');
            }, 5000);
        </script>        
    </body>
</html>
