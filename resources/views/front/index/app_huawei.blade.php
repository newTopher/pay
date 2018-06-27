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
                        <h3 class="title">EMUI系统权限设置</h3>
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
                <h4 class="page-title">华为手机 - 系统权限设置</h4>
                <hr>
                <!-- page-title end -->
                <h5>1.安装成功，开启后台运行，自启动，信任该应用</h5>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/huawei2.jpg') }}"></p>
                <h5>2.开启WapsPay的通知使用权</h5>
                <p>初次安装App后打开，会自动跳转到通知使用权页，找到WapsPay，并开启。</p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/huawei1.jpg') }}"></p>
                <h5>3.打开WapsPay、微信、支付宝3个APP的开机自启权限</h5>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/huawei3.jpg') }}"></p>

                <h5>4.在内存中锁住WapsPay、支付宝、微信，不要被系统清理</h5>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/oppo4.jpg') }}"></p>
                <h5>5.把WapsPay、微信、支付宝3个App的推送通知全部开启</h5>
                <p>在系统【设置】 - 【通知和状态栏】 - 【通知管理】中，找到这3个App，把里面的开关全部打开</p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui5.jpg') }}"></p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui5-2.jpg') }}"></p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui5-3.jpg') }}"></p>
                <h5>7.关闭微信免打扰</h5>
                <p>在微信的【设置】 - 【勿扰模式】中，关闭勿扰模式</p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui7-2.jpg') }}"></p>
                <h5>8.打开支付宝支付助手提醒</h5>
                <p>在支付宝主页，点支付助手，进入支付助手设置，打开提醒</p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui7-3.jpg') }}"></p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui7-4.jpg') }}"></p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui7-5.jpg') }}"></p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui7.jpg') }}"></p>
                <h5>9.打开微信中的二维码收款语音提醒</h5>
                <p>在微信【我】 - 【钱包】 - 【收付款】 - 【二维码收款】的右上角...中，开启收款语音提醒</p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui8.jpg') }}"></p>
            </div>
            <!-- main end -->

        </div>
    </div>
</section>

@stop