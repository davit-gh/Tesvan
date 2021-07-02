<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tesvan Team</title>

    <link rel="icon" href="{{ url('/uploads/2020/05/logo.png') }}" sizes="192x192">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('merged.css') }}?v={{ strtotime(date('YmdHis')) }}"/>
    @yield('styles')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-05657KC6FK"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-05657KC6FK');
    </script>
</head>
<body>

    <style type="text/css">
    .img-fluid {
        border-radius: 20px;
    }
    </style>
    {{-- <div id="cover">
        <div class="pb-3">
            <span> Tesvan </span>
        </div>

        <div>
            <div class="loader_col">
                <img src="/images/logo.png" class="logo" alt="Logo">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="loader_svg" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <path d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50" fill="#f4b41a" stroke="none">
                        <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0 50 51;360 50 51"></animateTransform>
                    </path>
                </svg>
            </div>
        </div>
    </div> --}}


    <header class="header">
        @include('header')
    </header>

    <div id="wrapp">

        @yield('content')

        <a href="javascript:" id="return-to-top">
            <div class="icon-chevron-up">
                <img src="/uploads/2020/05/top-arrow.png" alt="">
            </div>
        </a>
    </div>

    <footer class="hue_bg_grey" style="width: auto !important;">
        @include('footer')
    </footer>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

    <script src="{{ url('merged.js') }}?v={{ strtotime(date('YmdHis')) }}"></script>

    @yield('scripts')
    <script type="text/javascript">
        const observer = lozad();
        observer.observe();

        function detCurrentMenu(hash, pathname){
            if (hash=="#banner"){
                $("#menu_aboutus").css('font-weight', 'bolder').css("display","inline-block").css("border-bottom","3px solid #ffc107").css("padding-bottom","4px");
            }
            if (pathname=="/education"){
                $("#menu_education").css('font-weight', 'bolder').css("display","inline-block").css("border-bottom","3px solid #ffc107").css("padding-bottom","4px");
            }
            if (pathname=="/job"){
                $("#menu_job").css('font-weight', 'bolder').css("display","inline-block").css("border-bottom","3px solid #ffc107").css("padding-bottom","4px");
            }
            if (pathname=="/courses"){
                $("#menu_courses").css('font-weight', 'bolder').css("display","inline-block").css("border-bottom","3px solid #ffc107").css("padding-bottom","4px");
            }
            if (pathname=="/projects"){
                $("#menu_projects").css('font-weight', 'bolder').css("display","inline-block").css("border-bottom","3px solid #ffc107").css("padding-bottom","4px");
            }
            if (pathname=="/team"){
                $("#menu_team").css('font-weight', 'bolder').css("display","inline-block").css("border-bottom","3px solid #ffc107").css("padding-bottom","4px");
            }
            if (pathname=="/blogs"){
                $("#menu_blog").css('font-weight', 'bolder').css("display","inline-block").css("border-bottom","3px solid #ffc107").css("padding-bottom","4px");
            }
        }

        var pathname = window.location.pathname;
        var hash = window.location.hash;
        detCurrentMenu(hash, pathname);

        $(document).on("click",function(e){
            var pathname = window.location.pathname;
            var hash = window.location.hash;
            detCurrentMenu(hash, pathname);
        })

        $(document).on("click",".go_to_cv",function(e){
            cv_name = $(this).data("cv-name");
            window.open('{{url("team/cv")}}'+"/"+cv_name);
        });

    </script>

</body>
</html>
