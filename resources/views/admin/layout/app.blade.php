<!doctype html>
<html
    lang="en"
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

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
                @include('admin.layout.menu')
            <!-- / Menu -->

            <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->
                        @include('admin.layout.navbar')
                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                        <div class="content-wrapper">
                            <!-- Content -->
                                <div class="container-xxl flex-grow-1 container-p-y">

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
                                        <a href="#" target="_blank" class="footer-link fw-bolder">The Web Brain Technology</a>
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
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
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
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    
    @yield('script')

    <script type="text/javascript">
        setTimeout(() => {
            $('.floating-alert').removeClass('show');
            $('.floating-alert').addClass('hide');
        }, 5000);
    </script>
</body>
</html>
