<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Zigofly">
    <meta name="author" content="Brance Technologirs">
    <meta name="keywords" content="zigofly">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="//fonts.googleapis.com">
    <link rel="preconnect" href="//images-na.ssl-images-amazon.com/">

    <!-- Title Page-->
    <title>{{trans('panel.site_title')}}</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('account/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('account/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('account/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('account/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- App CSS-->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('css/animate/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('account/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('account/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('account/css/theme.css')}}" rel="stylesheet" media="all">

    @yield('styles')

{{--    <link href="css/zigo.css" rel="stylesheet" media="all">--}}

</head>

<body class="animsition">
    <div class="page-wrapper">
        @include('partials.sidebar')
        @include('partials.chat')
        <div class="page-container">
            @include('partials.navbar')'

            @yield('content')

            <!-- fab chat -->
            <button class="btn pmd-btn-fab pmd-ripple-effect text-light pmd-btn-raised btn-chat" type="button" aria-label="chat with us"><i class="zmdi zmdi-comment-outline fs-23"></i></button>

            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © {{date('Y')}} Zigofly. All rights reserved. <a href="https://zigofly.com">Zigofly Kenya Ltd</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- App JS-->
<script src="{{asset('js/manifest.js')}}"></script>
<script src="{{asset('js/vendor.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

<!-- Vendor JS       -->
<script src="{{asset('account/vendor/wow/wow.min.js')}}"></script>
<script src="{{asset('account/vendor/animsition/animsition.min.js')}}"></script>
<script src="{{asset('account/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('account/vendor/select2/select2.min.js')}}"></script>

<!-- Main JS-->
<script src="{{asset('account/js/main.js')}}"></script>
<script src="{{asset('account/js/chat.js')}}"></script>
@yield('scripts')

</body>

</html>
