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
                    <h4 class="page-title">订单查询接口(可选接口)</h4>
                    <hr>
                    <!-- page-title end -->
                    <p>用来主动查询订单是否支付成功，一般情况只用支付接口即可。如果您服务器中断了一段时间，可以用这个接口，快速获取中断时期的订单的支付状态。注意：此接口不能频繁查询,一个订单一分种只能查询一次</p>
                    <h5>接口URL：</h5>
                    <pre>https://api.bbbapi.com/get_order_staus_by_id</pre>
                    <h5>传参方式：Get</h5>
                    <hr>

                    <h5>请求参数：</h5>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>参数名</th>
                            <th>含义</th>
                            <th>类型</th>
                            <th>说明</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><small>uid</small></td>
                            <td><small>商户uid</small></td>
                            <td><small>string(24)</small></td>
                            <td><small>必填。您的商户唯一标识，注册后在设置里获得。一个24位字符串</small></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><small>orderid</small></td>
                            <td><small>商户自定义订单号</small></td>
                            <td><small>string(50)</small></td>
                            <td><small>必填。</small></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><small>r</small></td>
                            <td><small>随机字符串</small></td>
                            <td><small>string(20)</small></td>
                            <td><small>必填。每次请求确保不一样</small></td>
                        </tr>
                        <td>4</td>
                        <td><small>key</small></td>
                        <td><small>秘钥</small></td>
                        <td><small>string(32)</small></td>
                        <td><small>必填。按顺序拼接：uid + orderid + r + token，取MD5-32位加密后的值，转小写。</small></td>
                        </tr>
                        </tbody>
                    </table>
                    <p class="text-danger"><strong>注意：Token在安全上非常重要，一定不要显示在任何网页代码、网址参数中。只可以放在服务端。计算key时，先在服务端计算好，把计算出来的key传出来。严禁在客户端计算key，严禁在客户端存储Token。</strong></p>

                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <!-- page-title start -->
                    <!-- ================ -->
                    <h4 class="page-title">返回值(Json字符串)</h4>
                    <hr>
                    <!-- page-title end -->


                    <h5>参数内容：</h5>
                    <pre>
    {
        //提示文字信息，成功失败。
        "msg":"OK",
        "data":{
            //商户自定义订单号
            "orderid":"f827f0192d2cc6a308a10d49",
            //订单状态：0-等待支付；1-付款成功；2-付款未完成
            "status":"1",
        },
        //code目前只返回1。
        "code":1,
        //url暂时没用
        "url":""
    }
</pre>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                </div>
                <!-- main end -->

            </div>
        </div>
    </section>

@stop