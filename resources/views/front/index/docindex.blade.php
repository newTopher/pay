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
                    <h4 class="page-title">准备工作</h4>
                    <hr>
                    <!-- page-title end -->
                    <h5>欢迎接入WapsPay支付接口。</h5>
                    <h5>在接入之前，请先确认是否完成以下4步：</h5>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>必要前提</th>
                            <th>说明</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><small>已有UID和Token。</small></td>
                            <td><small>注册账号，在“我的Paysapi”-“账号设置”-“API接口信息”中获取。</small></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><small>已上传支付宝，微信不设金额二维码各一张</small></td>
                            <td><small>可能用到的定额二维码多多益善。在“我的WapsPay”-“商品管理”中上传。</small></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><small>已开通套餐</small></td>
                            <td><small>在首页开通。未开通的账号，跳转进支付页会提示错误。</small></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><small>已安装APP，并按要求设置完毕。</small></td>
                            <td><small><a href="{{url('/appdownload')}}">安装链接</a> <a href="{{url('/app_miui')}}">设置要求</a></small></td>
                        </tr>
                        </tbody>
                    </table>
                    <h5>完成以上4步，就可以开始接入API接口了。(点左侧导航)</h5>
                </div>
                <!-- main end -->

            </div>
        </div>
    </section>

@stop