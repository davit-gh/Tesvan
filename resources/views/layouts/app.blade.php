<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta_description')
    <title>@yield('title','Tesvan Team')</title>


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
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '261379785874369');
        fbq('track', 'PageView');
    </script>
    <noscript>
       <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=261379785874369&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
</head>
<body>
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
            window.open(cv_name);
        });

    </script>

</body>
</html>
