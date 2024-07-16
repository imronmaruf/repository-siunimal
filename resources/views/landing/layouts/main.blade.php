<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>@stack('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landings/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('landings/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('landings/assets/css/templatemo-scholar.css') }}">
    <link rel="stylesheet" href="{{ asset('landings/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('landings/assets/css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <style>
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>

    @stack('css')

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    @include('landing.layouts.partials.navbar')
    <!-- ***** Header Area End ***** -->

    @yield('content')

    @include('landing.layouts.partials.footer')


    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('landings/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('landings/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landings/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('landings/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('landings/assets/js/counter.js') }}"></script>
    <script src="{{ asset('landings/assets/js/custom.js') }}"></script>

</body>

</html>
