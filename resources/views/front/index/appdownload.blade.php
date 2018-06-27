@extends('front.layouts.master')

@section('content')

<!-- page-intro start-->
<!-- ================ -->
<div class="page-intro">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><i class="fa fa-home pr-10"></i><a href="/">首页</a></li>
                    <li class="active">App下载</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- page-intro end -->

<section class="main-container">

    <div class="container">
        <div class="row">

            <!-- sidebar start -->
            <aside class="col-md-3">
                <div class="sidebar">
                    <div class="block clearfix">
                        <h3 class="title">手机权限设置</h3>
                        <div class="separator"></div>
                        @include('front.public.appset_nav')
                    </div>
                </div>
            </aside>
            <!-- sidebar end -->

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-9">

                <!-- page-title start -->
                <!-- ================ -->
                <h4 class="page-title">App下载页</h4>
                <hr>
                <!-- page-title end -->
                <p class="text-center"><a href="http://cdn.weathlike.com/paysapi_release_v1.8.0-20180513_jiagu.apk" class="btn btn-default btn-lg">安卓版下载</a></p>
                <p class="text-center">版本：1.4.0</p>
                <p class="text-center">安装包大小：2.04 Mb</p>
                <p class="text-center">更新日期：2018-1-29</p>
                <h4 class="page-title">权限开启教程</h4>
                <hr>
                <p>下载App后，<strong>必须开启相关权限，否则即使装上也无效</strong>。部分品牌手机没有教程，请参考小米的设置，找到对应的同类设置项修改。完成后，如能截图发给我们，我们会非常感激。</p>
                <div class="gallery row">
                    <div class="gallery-item col-xs-3">
                        <div class="overlay-container">
                            <img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/logo_mi.jpg') }}" alt="">
                            <a href="/app_miui" class="overlay small">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item col-xs-3">
                        <div class="overlay-container">
                            <img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/logo_oppo.jpg') }}" alt="">
                            <a href="/app_oppo" class="overlay small">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item col-xs-3">
                        <div class="overlay-container">
                            <img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/logo_huawei.jpg') }}" alt="">
                            <a href="/app_huawei" class="overlay small">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item col-xs-3">
                        <div class="overlay-container">
                            <img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/logo_vivo.jpg') }}" alt="">
                            <a href="/app_vivo" class="overlay small">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item col-xs-3">
                        <div class="overlay-container">
                            <img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/logo_samsung.jpg') }}" alt="">
                            <a href="/app_samsung" class="overlay small">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item col-xs-3">
                        <div class="overlay-container">
                            <img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/logo_meizu.jpg') }}" alt="">
                            <a href="/app_meizu" class="overlay small">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item col-xs-3">
                        <div class="overlay-container">
                            <img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/logo_zte.jpg') }}" alt="">
                            <a href="/app_zte" class="overlay small">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                    </div>
                    <div class="gallery-item col-xs-3">
                        <div class="overlay-container">
                            <img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/logo_lg.jpg') }}" alt="">
                            <a href="/app_lg" class="overlay small">
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- main end -->

        </div>
    </div>
</section>

@stop