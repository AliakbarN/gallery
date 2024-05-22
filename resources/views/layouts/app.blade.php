<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- ========== Meta Tags ========== -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        @stack('meta')
        <!-- ========== Title ========== -->
        <title>Gallery</title>
        <!-- ========== Favicon Ico ========== -->
        <!--<link rel="icon" href="fav.ico">-->
        <!-- ========== STYLESHEETS ========== -->
        <!-- Bootstrap CSS -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Fonts Icon CSS -->
        <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/et-line.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/ionicons.min.css') }}" rel="stylesheet">
        <!-- Carousel CSS -->
        <link href="{{ asset('assets/css/slick.css') }}" rel="stylesheet">
        <!-- Magnific-popup -->
        <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
        <!-- Custom styles for this template -->
        <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />
        <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/fontawesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/flag-icons.css') }}" />

        @stack('stylesheets')
    </head>
    <body>
        <div class="loader">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>
        </div>

        <div class="body-container container-fluid">
            <a class="menu-btn" href="javascript:void(0)">
                <i class="ion ion-grid"></i>
            </a>
            <div class="row justify-content-center">
                <!--=================== side menu ====================-->
                <x-menu></x-menu>
                <!--=================== side menu end====================-->

                <!--=================== content body ====================-->
                <div class="col-lg-10 col-md-9 col-12 body_block  align-content-center">
                    <h1>@yield('title')</h1>

                    @yield('content')

                </div>
                <!--=================== content body end ====================-->
            </div>
        </div>


        <!-- jquery -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <!-- bootstrap -->
        <script src="{{ asset('assets/js/popper.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
        <!--slick carousel -->
        <script src="{{ asset('assets/js/slick.min.js') }}"></script>
        <!--Portfolio Filter-->
        <script src="{{ asset('assets/js/imgloaded.js') }}"></script>
        <script src="{{ asset('assets/js/isotope.js') }}"></script>
        <!-- Magnific-popup -->
        <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
        <!--Counter-->
        <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
        <!-- WOW JS -->
        <script src="{{ asset('assets/js/wow.min.js') }}"></script>
        <!-- Custom js -->
        <script src="{{ asset('assets/js/main.js') }}"></script>

        @stack('scripts')
    </body>
</html>
