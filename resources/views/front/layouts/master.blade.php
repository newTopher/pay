<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-cn">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>PaysApi - 个人支付收款API接口提供商</title>
    <meta name="language" content="cn" />
    <meta name="description" content="专为个人收款而生的支付工具。为支付宝、微信支付的个人账户，提供即时到账收款API接口。安全可靠，费率低。">

    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Web Fonts -->



    <!-- Bootstrap core CSS -->

    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/css/bootstrap.min.css') }}"  rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/css/font-awesome.min.css') }}"  rel="stylesheet">

    <!-- Fontello CSS -->
    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/fonts/fontello/css/fontello.css') }}"  rel="stylesheet">
    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/css/iconfont.css') }}"  rel="stylesheet">

    <!-- Plugins -->
    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/css/settings.css') }}"  media="screen" rel="stylesheet">
    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/css/extralayers.css') }}"  media="screen" rel="stylesheet">
    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/css/magnific-popup.min.css') }}"  rel="stylesheet">
    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/css/animations.css') }}"  rel="stylesheet">
    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/css/owl.carousel.min.css') }}"  rel="stylesheet">
    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/css/toastr.min.css') }}"  rel="stylesheet">

    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/css/style.css') }}"  rel="stylesheet">

    <!-- Color Scheme (In order to change the color scheme, replace the red.css with the color scheme that you prefer)-->
    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/css/green.css') }}"  rel="stylesheet">

    <!-- Custom css -->
    <link href="{{ \Illuminate\Support\Facades\URL::asset('/source/css/custom.css') }}"  rel="stylesheet">
    <!-- <link href="/css/custom.css" rel="stylesheet"> -->
    <!--[if lt IE 9]-->
    <script type="text/javascript"  src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/html5shiv.js') }}" ></script >
    <script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/selectivizr.js') }}" ></script>
    <!--[endif]-- >

    <!--Google转化统计-->
    <!-- Global site tag (gtag.js) - Google AdWords: 851025988
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-851025988"></script>
    -->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-851025988');
    </script>

    <!-- Event snippet for PaysApi注册转化 conversion page
    In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
    <script>
        function gtag_report_conversion(url) {
            var callback = function () {
                if (typeof(url) != 'undefined') {
                    window.location = url;
                }
            };
            gtag('event', 'conversion', {
                'send_to': 'AW-851025988/2xgJCM_w3HoQxMDmlQM',
                'event_callback': callback
            });
            return false;
        }
    </script>



</head>

<!-- body classes:
        "boxed": boxed layout mode e.g. <body class="boxed">
        "pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1">
-->
<body class="front">
<!-- scrollToTop -->
<!-- ================ -->
<div class="scrollToTop"><i class="icon-up-open-big"></i></div>

<!-- page wrapper start -->
<!-- ================ -->
<div class="page-wrapper">

    @include('front.layouts.header')


    @yield('content')


    @include('front.layouts.footer')

</div>
<!-- page-wrapper end -->

<!-- JavaScript files placed at the end of the document so the pages load faster
================================================== -->
<!-- Jquery and Bootstap core js files -->
<script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/jquery.min.js') }}" ></script>
<script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/bootstrap.min.js') }}" ></script>

<!-- Modernizr javascript -->
<script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/modernizr.min.js') }}" ></script>

<!-- jQuery REVOLUTION Slider  -->
<script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/jquery.themepunch.tools.min.js') }}" ></script>
<script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/jquery.themepunch.revolution.min.js') }}" ></script>

<!-- Isotope javascript -->
<script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/isotope.pkgd.min.js') }}" ></script>

<!-- Owl carousel javascript -->
<script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/owl.carousel.js') }}" ></script>

<!-- Magnific Popup javascript -->
<script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/jquery.magnific-popup.min.js') }}" ></script>

<!-- Appear javascript -->
<script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/jquery.appear.js') }}" ></script>

<!-- Count To javascript -->
<script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/jquery.countTo.js') }}" ></script>

<!-- Parallax javascript -->
<script src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/jquery-parallax.js') }}" ></script>

<!-- Contact form -->
<script src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/jquery.validate.js') }}" ></script>
<script src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/messages_zh.js') }}" ></script>

<!-- Toastr -->
<script src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/toastr.min.js') }}" ></script>

<!-- Initialization of Plugins -->
<script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/template.js') }}" ></script>

<!-- Custom Scripts -->
<!-- <script type="text/javascript" src="js/custom.js"></script>-->
<script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/source/js/custom.js') }}" ></script>
<script>

    $("#loginPassword").keyup(function(event){
        if(event.keyCode ==13){
            $("#loginBtn").trigger("click");
        }
    });



</script>


@yield('scripts')

</body>
</html>
