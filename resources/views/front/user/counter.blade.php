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
                    <li class="active">我的收入统计</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- page-intro end -->


<section class="main-container">
    <div class="container">
        @if($userInfo->money < 10)
        <div class="main col-md-12">
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <strong>余额不足</strong> 余额应保持10元以上，用于扣除手续费
            </div>
        </div>
        @endif

        <div class="call-to-action">
            <div class="row">

                <div class="col-md-6">
                    <h1 class="title text-left">账户余额:￥{{$userInfo->money}} </h1>
                    <p class="text-left"><a href="{{url('user/myMoneyHistory')}}"><i title="查看我的余额明细" class="fa fa-file-text-o pr-5"></i>余额明细</a></p>
                </div>
                <div class="col-md-6">
                    <div class="text-right">
                        <a id="showbar" href="#moneyin-dialog" class="btn btn-default btn-lg popup-with-zoom-anim">充值</a> <!--<a href="#moneyback-dialog" id="moneyback" class="btn btn-default btn-lg popup-with-zoom-anim">提现</a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 充值模态框 -->
    <div id="moneyin-dialog" class="zoom-anim-dialog mfp-hide small-dialog">
        <h2>存入金额￥</h2>
        <div class="form-group">
            <input type="text" class="form-control" id="inputprice" placeholder="例如：50.00">
        </div>

        <p class="text-center"><a href="#" id="alipay" class="btn btn-primary moneyin"><i class="iconfont iconfont-umidd17 pl-10"></i> 支付宝支付</a> &nbsp;&nbsp;  <a href="#" id="weixin" class="btn btn-success moneyin"><i class="iconfont iconfont-pay-wechat pr-10"></i> 微信支付</a>
        </p>
    </div>

    <!-- 提现模态框 -->
    <div id="moneyback-dialog" class="zoom-anim-dialog mfp-hide small-dialog">
        <h2>提现金额￥</h2>
        <div class="form-group">
            <input type="text" class="form-control" id="moneybackprice" placeholder="可提现金额：225.76">
        </div>

        <p class="text-center">提现到：支付宝收款二维码 <a href="/mySetting"> <i class="fa fa-pencil pl-10"></i></a></p>

        <p class="text-center"><a href="#" id="btnmoneyback" class="btn btn-default"> 提现</a>
        </p>
    </div>



    <div class="container">
        <div class="row">

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">

                <div class="stats row grid-space-10">
                    <div class="col-md-3 col-sm-6">
                        <div class="box-style-1 gray-bg">
                            <h2 class="title">今日收入</h2>
                            <i class="iconfont iconfont-jintian"></i>
                            <span class="stat-num" data-to="{{$counterInfo['todayMoney']}}" data-decimals="2" data-speed="500">0</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="box-style-1 gray-bg">
                            <h2 class="title">昨日收入</h2>
                            <i class="iconfont iconfont-zuotian"></i>
                            <span class="stat-num" data-to="{{$counterInfo['yesterdayMoney']}}" data-decimals="2" data-speed="500">0</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="box-style-1 gray-bg">
                            <h2 class="title">7天收入</h2>
                            <i class="iconfont iconfont-7tianshouyi"></i>
                            <span class="stat-num" data-to="{{$counterInfo['sevenMoney']}}" data-decimals="2" data-speed="1000">0</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="box-style-1 gray-bg">
                            <h2 class="title">30天收入</h2>
                            <i class="iconfont iconfont-30tianshouyi"></i>
                            <span class="stat-num" data-to="{{$counterInfo['monthMoney']}}" data-decimals="2" data-speed="1000">0</span>
                        </div>
                    </div>
                </div>
                <div class="stats row grid-space-10">
                    <div class="col-md-3 col-sm-6">
                        <div class="box-style-1 gray-bg">
                            <h2 class="title">今日订单</h2>
                            <i class="iconfont iconfont-jintian"></i>
                            <span class="stat-num" data-to="{{$counterInfo['todayOrders']}}" data-speed="500">0</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="box-style-1 gray-bg">
                            <h2 class="title">昨日订单</h2>
                            <i class="iconfont iconfont-zuotian"></i>
                            <span class="stat-num" data-to="{{$counterInfo['yesterdayOrders']}}" data-speed="500">0</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="box-style-1 gray-bg">
                            <h2 class="title">7天订单</h2>
                            <i class="iconfont iconfont-7tianshouyi"></i>
                            <span class="stat-num" data-to="{{$counterInfo['sevenOrders']}}" data-speed="1000">0</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="box-style-1 gray-bg">
                            <h2 class="title">30天订单</h2>
                            <i class="iconfont iconfont-30tianshouyi"></i>
                            <span class="stat-num" data-to="{{$counterInfo['monthOrders']}}" data-speed="1000">0</span>
                        </div>
                    </div>
                </div>

            </div>
            <!-- main end -->



        </div>
    </div>
</section>
<!-- main-container end -->
<button class="btn-default btn" data-toggle="modal" data-target="#paySuccess" style="display:none;"  id="showmodal">111</button>
<!--充值成功 Modal -->
<div class="modal fade" id="paySuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">支付成功</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                    <tr>

                        <th>订单详情</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        <td>订单编号</td>
                        <td></td>
                    </tr>
                    <tr>

                        <td>支付渠道</td>
                        <td>0</td>
                    </tr>
                    <tr>

                        <td>金额</td>
                        <td>￥0.00</td>
                    </tr>
                    <tr>

                        <td>开始时间</td>
                        <td>0</td>
                    </tr>
                    <tr>

                        <td>完成时间</td>
                        <td>0</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>



<form style='display:none;' id='formpay' name='formpay' method='post' action='{{ url('/pay/index') }}'>
    <input name='istype' id='istype' type='text' value='' />
    <input name='key' id='key' type='text' value=''/>
    <input name='notify_url' id='notify_url' type='text' value=''/>
    <input name='orderid' id='orderid' type='text' value=''/>
    <input name='orderuid' id='orderuid' type='text' value=''/>
    <input name='price' id='price' type='text' value=''/>
    <input name='return_url' id='return_url' type='text' value=''/>
    <input name='uid' id='uid' type='text' value=''/>
    <input type='submit' id='submitdemo1'>
</form>

<!-- main end -->
@stop

@section('scripts')
    <script type="text/javascript">

        $().ready(function(){

            var istype;
            $(".moneyin").click(function(){
                if ($(this).attr('id') == 'alipay'){
                    istype = 1;
                }else{
                    istype = 2;
                }

                $.post(
                    "/user/recharge",
                    {
                        price : $("#inputprice").val(),
                        istype : istype,
                    },
                    function(data){
                        if (data.code > 0){
                            toastr.success(data.msg);
                            $("#istype").val(data.data.istype);
                            $('#key').val(data.data.key);
                            $('#notify_url').val(data.data.notify_url);
                            $('#orderid').val(data.data.orderid);
                            $('#orderuid').val(data.data.orderuid);
                            $('#price').val(data.data.price);
                            $('#return_url').val(data.data.return_url);
                            $('#uid').val(data.data.uid);
                            $('#submitdemo1').click();
                        } else {
                            toastr.warning(data.msg);
                        }
                    }
                );
            });

            $("#btnmoneyback").click(function(){
                if ($("#moneybackprice").val() < 10){
                    toastr.warning("提现金额不能低于10元");
                }else{
                    $.post(
                        "/manageMoneyback",
                        {
                            price:$("#moneybackprice").val(),
                        },
                        function(data){
                            if (data.code > 0){
                                toastr.success(data.msg);
                                setTimeout(function(){
                                    location.reload();
                                }, 2000);
                            } else {
                                toastr.warning(data.msg);
                            }
                        }
                    );
                }

            });

            if (""){
                $("#showmodal").click();
            }


            $('.popup-with-zoom-anim').magnificPopup({
                type: 'inline',

                fixedContentPos: false,
                fixedBgPos: true,

                overflowY: 'auto',

                closeBtnInside: true,
                preloader: false,

                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });

            $('.popup-with-move-anim').magnificPopup({
                type: 'inline',

                fixedContentPos: false,
                fixedBgPos: true,

                overflowY: 'auto',

                closeBtnInside: true,
                preloader: false,

                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-slide-bottom'
            });
        });
    </script>

    <style type="text/css">
        /* Styles for dialog window */
        #small-dialog {
            background: white;
            padding: 20px 30px;
            text-align: left;
            max-width: 600px;
            margin: 40px auto;
            position: relative;
        }


        /**
         * Fade-zoom animation for first dialog
         */

        /* start state */
        .my-mfp-zoom-in .zoom-anim-dialog {
            opacity: 0;

            -webkit-transition: all 0.2s ease-in-out;
            -moz-transition: all 0.2s ease-in-out;
            -o-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;



            -webkit-transform: scale(0.8);
            -moz-transform: scale(0.8);
            -ms-transform: scale(0.8);
            -o-transform: scale(0.8);
            transform: scale(0.8);
        }

        /* animate in */
        .my-mfp-zoom-in.mfp-ready .zoom-anim-dialog {
            opacity: 1;

            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1);
        }

        /* animate out */
        .my-mfp-zoom-in.mfp-removing .zoom-anim-dialog {
            -webkit-transform: scale(0.8);
            -moz-transform: scale(0.8);
            -ms-transform: scale(0.8);
            -o-transform: scale(0.8);
            transform: scale(0.8);

            opacity: 0;
        }

        /* Dark overlay, start state */
        .my-mfp-zoom-in.mfp-bg {
            opacity: 0;
            -webkit-transition: opacity 0.3s ease-out;
            -moz-transition: opacity 0.3s ease-out;
            -o-transition: opacity 0.3s ease-out;
            transition: opacity 0.3s ease-out;
        }
        /* animate in */
        .my-mfp-zoom-in.mfp-ready.mfp-bg {
            opacity: 0.8;
        }
        /* animate out */
        .my-mfp-zoom-in.mfp-removing.mfp-bg {
            opacity: 0;
        }



        /**
         * Fade-move animation for second dialog
         */

        /* at start */
        .my-mfp-slide-bottom .zoom-anim-dialog {
            opacity: 0;
            -webkit-transition: all 0.2s ease-out;
            -moz-transition: all 0.2s ease-out;
            -o-transition: all 0.2s ease-out;
            transition: all 0.2s ease-out;

            -webkit-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
            -moz-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
            -ms-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
            -o-transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );
            transform: translateY(-20px) perspective( 600px ) rotateX( 10deg );

        }

        /* animate in */
        .my-mfp-slide-bottom.mfp-ready .zoom-anim-dialog {
            opacity: 1;
            -webkit-transform: translateY(0) perspective( 600px ) rotateX( 0 );
            -moz-transform: translateY(0) perspective( 600px ) rotateX( 0 );
            -ms-transform: translateY(0) perspective( 600px ) rotateX( 0 );
            -o-transform: translateY(0) perspective( 600px ) rotateX( 0 );
            transform: translateY(0) perspective( 600px ) rotateX( 0 );
        }

        /* animate out */
        .my-mfp-slide-bottom.mfp-removing .zoom-anim-dialog {
            opacity: 0;

            -webkit-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg );
            -moz-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg );
            -ms-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg );
            -o-transform: translateY(-10px) perspective( 600px ) rotateX( 10deg );
            transform: translateY(-10px) perspective( 600px ) rotateX( 10deg );
        }

        /* Dark overlay, start state */
        .my-mfp-slide-bottom.mfp-bg {
            opacity: 0;

            -webkit-transition: opacity 0.3s ease-out;
            -moz-transition: opacity 0.3s ease-out;
            -o-transition: opacity 0.3s ease-out;
            transition: opacity 0.3s ease-out;
        }
        /* animate in */
        .my-mfp-slide-bottom.mfp-ready.mfp-bg {
            opacity: 0.8;
        }
        /* animate out */
        .my-mfp-slide-bottom.mfp-removing.mfp-bg {
            opacity: 0;
        }
    </style>

@stop