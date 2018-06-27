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
                        <li class="active">API接入文档</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- page-intro end -->

    <!-- main-container start -->
    <!-- ================ -->
    <section class="main-container">

        <div class="container">
            <div class="row">

                <!-- sidebar start -->
                <aside class="col-md-3">
                    <div class="sidebar">
                        <div class="block clearfix">
                            <h3 class="title">API接入文档</h3>
                            <div class="separator"></div>
                            @include('front.public.apidoc_nav')
                        </div>
                    </div>
                </aside>
                <!-- sidebar end -->

                <!-- main start -->
                <!-- ================ -->
                <div class="main col-md-9">

                    <!-- page-title start -->
                    <!-- ================ -->
                    <h4 class="page-title">Demo下载</h4>
                    <hr>
                    <!-- page-title end -->
                    <p><a href="https://c.weathlike.com/paysapi/PHPDemo.zip">PHP-Demo下载</a></p>
                    <p><a href="https://c.weathlike.com/paysapi/JavaDemo20171220.zip">Java-Demo下载</a></p>
                    <p><a href="https://c.weathlike.com/paysapi/ASPDemo.zip">ASP-Demo下载</a></p>
                    <p><a href="https://c.weathlike.com/paysapi/NodeJsDemo20180224.zip">NodeJs-Demo下载</a></p>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                </div>
                <!-- main end -->

            </div>
        </div>
    </section>

@stop