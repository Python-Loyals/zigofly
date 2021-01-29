<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Zigofly">
    <meta name="author" content="Brance Technologies">
    <meta name="keywords" content="zigofly">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://images-na.ssl-images-amazon.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link rel="preload" as="style" href="{{asset('css/app.css')}}">
    <link rel="preload" as="style" href="{{asset('account/css/theme.css')}}">
    <link rel="preload" as="script" href="{{asset('js/vendor.js')}}">

    <!-- Title Page-->
    <title>{{trans('panel.site_title')}}</title>

    <!-- Fontfaces CSS-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="{{asset('account/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('account/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" />

    <!-- App CSS-->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('css/animate/animate.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/css/animsition.min.css" integrity="sha512-SagM1PHxt5mWDyWARVY6UOdhM5A8J+R1UqIWcGfiwOd+be7uHQagB+JQOmfVZF8jjJQqbyuWzw/KXfb4yqjBkQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hamburgers/1.1.3/hamburgers.min.css" integrity="sha512-+mlclc5Q/eHs49oIOCxnnENudJWuNqX5AogCiqRBgKnpoplPzETg2fkgBFVC6WYUVxYYljuxPNG8RE7yBy1K+g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" integrity="sha512-n+g8P11K/4RFlXnx2/RW1EZK25iYgolW6Qn7I0F96KxJibwATH3OoVCQPh/hzlc4dWAwplglKX8IVNVMWUUdsw==" crossorigin="anonymous" />

    <!-- Main CSS-->
    <link href="{{asset('account/css/theme.css')}}" rel="stylesheet" media="all">

    @yield('styles')

</head>

<body class="animsition">
    <div class="page-wrapper">
        @include('partials.customer.sidebar')
        @include('partials.customer.chat')
        <div class="page-container">
            @include('partials.customer.navbar')

            @yield('content')

            <!-- fab chat -->
                <style>
                    .user-unread {
                        border-radius: 50%;
                        position: fixed!important;
                        right: 0.5rem;
                        bottom: 3rem;
                        z-index: 1000;
                        font-size: 13px;
                        width: 25px;
                        height: 25px;
                        text-align: center;
                        background: #d43b7f;
                        color: #fff;

                    }
                </style>
            <button class="btn pmd-btn-fab pmd-ripple-effect text-light pmd-btn-raised btn-chat" type="button"
                    aria-label="chat with us">
                <i class="zmdi zmdi-comment-outline fs-23"></i>
            </button>
                @if(count(Auth::user()->unreadMessages)>0)
                    <span class="user-unread bg-theme">{{count(Auth::user()->unreadMessages)}}</span>
                @endif

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.min.js" integrity="sha512-pYd2QwnzV9JgtoARJf1Ui1q5+p1WHpeAz/M0sUJNprhDviO4zRo12GLlk4/sKBRUCtMHEmjgqo5zcrn8pkdhmQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js" integrity="sha512-yUNtg0k40IvRQNR20bJ4oH6QeQ/mgs9Lsa6V+3qxTj58u2r+JiAYOhOW0o+ijuMmqCtCEg7LZRA+T4t84/ayVA==" crossorigin="anonymous"></script>
{{--<script async src="{{asset('account/vendor/select2/select2.min.js')}}"></script>--}}

<!-- Main JS-->
<script src="{{asset('account/js/main.js')}}"></script>
<script src="{{asset('account/js/chat.js')}}"></script>
@yield('scripts')
<script>

</script>
</body>

</html>
