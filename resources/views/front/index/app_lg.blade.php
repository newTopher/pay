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
                            <h3 class="title">LG手机系统权限设置</h3>
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
                    <h4 class="page-title">LG手机 - 系统权限设置</h4>
                    <hr>
                    <!-- page-title end -->
                    <p>下载App后，<strong>必须开启相关权限，否则即使装上也无效</strong>。本品牌手机暂无教程，请参考小米的设置，找到对应的同类设置项修改。完成后，如能截图发给我们，我们会非常感激。</p>
                </div>
                <!-- main end -->
            </div>
        </div>
    </section>

@stop