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
                        <h3 class="title">MIUI系统权限设置</h3>
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
                <h4 class="page-title">小米手机 - MIUI系统权限设置</h4>
                <hr>
                <!-- page-title end -->
                <h5>1.开启WapsPay的通知使用权</h5>
                <p>为更顺畅的使用WapsPay收款，避免收不到通知，通知延迟等情况，请检查以下设置，并按要求设置</p>
                <p>初次安装App后打开，会自动跳转到通知使用权页，找到WapsPay，并开启。</p>
                <p>后期要开启，请在系统【设置】 - 【其他高级设置】 - 【安全和隐私】 - 【通知读取权限】中开启</p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui1-1.jpg') }}"></p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui1-2.jpg') }}"></p>
                <h5>2.关闭系统神隐模式</h5>
                <p>在系统【设置】 - 【其他高级设置】 - 【电量与性能】 - 【神隐模式】中关闭</p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui2.jpg') }}"></p>
                <h5>3.打开WapsPay、微信、支付宝3个APP的开机自启权限</h5>
                <p>在桌面找到系统自带的【安全中心】APP -【授权管理】 - 【自启动管理】中开启</p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui3.jpg') }}"></p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui3-2.jpg') }}"></p>
                <h5>4.在内存中锁住WapsPay、支付宝、微信，不要被系统清理</h5>
                <p>启动一次WapsPay、支付宝、微信。然后点击手机底部硬件按钮中的“设置”按钮，调起“一键清理”功能，按住图标向下拖拽，就可以把App锁住。</p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui4.jpg') }}"></p>
                <h5>5.关闭WLAN优化</h5>
                <p>部分旧的MIUI系统有此选项：系统【设置】 - 【WLAN】 -【高级设置】 -【WLAN优化】，关闭它。</p>
                <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui6.jpg') }}"></p>
                <h5>6.把WapsPay、微信、支付宝3个App的推送通知全部开启</h5>
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