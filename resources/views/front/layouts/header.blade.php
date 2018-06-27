<!-- header-top start -->
<!-- ================ -->


<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-2 col-sm-6">

                <!-- header-top-first start -->
                <!-- ================ -->
                <div class="header-top-first clearfix">
                    <ul class="social-links clearfix hidden-xs">
                        <li class="qq"><a href="#footer"><i class="fa fa-qq"></i></a></li>
                        <li class="weixin"><a href="#footer"><i class="fa fa-weixin"></i></a></li>
                    </ul>
                    <div class="social-links hidden-lg hidden-md hidden-sm">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></button>
                            <ul class="dropdown-menu dropdown-animation">
                                <li class="qq"><a target="_blank" href="#footer"><i class="fa fa-qq"></i></a></li>
                                <li class="weixin"><a target="_blank" href="#footer"><i class="fa fa-weixin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- header-top-first end -->

            </div>
            <div class="col-xs-10 col-sm-6">

                <!-- header-top-second start -->
                <!-- ================ -->
                <div id="header-top-second"  class="clearfix">

                    <!-- header top dropdowns start -->
                    <!-- ================ -->
                    <div class="header-top-dropdown">

                        @include('front.layouts.login')

                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i> 搜索</button>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-animation">
                                <li>
                                    <form role="search" class="search-box">
                                        <div class="form-group has-feedback">
                                            <input type="text" class="form-control" placeholder="Search">
                                            <i class="fa fa-search form-control-feedback"></i>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>


                    </div>
                    <!--  header top dropdowns end -->

                </div>
                <!-- header-top-second end -->

            </div>
        </div>
    </div>
</div>
<!-- header-top end -->
<!-- header start (remove fixed class from header in order to disable fixed navigation mode) -->
<!-- ================ -->
<header class="header fixed clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-3">

                <!-- header-left start -->
                <!-- ================ -->
                <div class="header-left clearfix">

                    <!-- logo -->
                    <div class="logo">
                        <a href="/" ><img id="logo" src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/logo_red.png') }}"  alt="WapsPay"></a>
                    </div>

                    <!-- name-and-slogan -->
                    <div class="site-slogan">
                        个人支付收款API接口提供商
                    </div>

                </div>
                <!-- header-left end -->

            </div>

            <div class="col-md-9">

                <!-- header-right start -->
                <!-- ================ -->
                <div class="header-right clearfix">

                    <!-- main-navigation start -->
                    <!-- ================ -->
                    <div class="main-navigation animated">

                        <!-- navbar start -->
                        <!-- ================ -->
                        <nav class="navbar navbar-default" role="navigation">
                            <div class="container-fluid">

                                <!-- Toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse scrollspy smooth-scroll" id="navbar-collapse-1">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/index/index'))class="active"@endif><a href="/index/index" >首页</a></li>

                                        <li class="dropdown">
                                            <a href="#header-top" class="dropdown-toggle" data-toggle="dropdown">新手引导</a>
                                            <ul class="dropdown-menu">
                                                <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/user/register'))class="active"@endif>
                                                    <a href="{{url('/user/register')}}" >免费注册</a></li>
                                                <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/appdownload'))class="active"@endif>
                                                    <a href="/appdownload" >安装APP</a></li>
                                                <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/docindex'))class="active"@endif>
                                                    <a href="/docindex" >看API文档自助接入</a></li>
                                                <li><a href="faqindex-selectid=collapse7.htm" >不懂接入？我们帮您</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#header-top" class="dropdown-toggle" data-toggle="dropdown">API接入文档</a>
                                            <ul class="dropdown-menu">
                                                <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/docindex'))class="active"@endif>
                                                    <a href="docindex" >准备工作</a></li>
                                                <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/docpay'))class="active"@endif>
                                                    <a href="/docpay" >发起付款接口</a></li>
                                                <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/docdemo'))class="active"@endif>
                                                    <a href="/docdemo" >Demo下载</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#header-top" class="dropdown-toggle" data-toggle="dropdown">帮助</a>
                                            <ul class="dropdown-menu">
                                                <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/faqindex'))class="active"@endif>
                                                    <a href="/faqindex" >接入常见问题</a></li>
                                                <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/faqused'))class="active"@endif>
                                                    <a href="/faqused" >使用过程中常见问题</a></li>
                                            </ul>
                                        </li>
                                        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/appdownload'))class="active"@endif>
                                            <a href="/appdownload" >APP下载</a></li>
                                        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/about'))class="active"@endif>
                                            <a href="/about" >关于我们</a></li>

                                    </ul>
                                </div>

                            </div>
                        </nav>
                        <!-- navbar end -->

                    </div>
                    <!-- main-navigation end -->

                </div>
                <!-- header-right end -->

            </div>
        </div>
    </div>
</header>
<!-- header end -->