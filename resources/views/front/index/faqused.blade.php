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
                        <li class="active">常见问题解答</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- page-intro end -->

    <!-- ================ -->
    <section class="main-container">

        <div class="container">
            <div class="row">

                <!-- sidebar start -->
                <aside class="col-md-3">
                    <div class="sidebar">
                        <div class="block clearfix">
                            <h3 class="title">常见问题解答</h3>
                            <div class="separator"></div>
                            @include('front.public.faq_nav')
                        </div>
                    </div>
                </aside>
                <!-- sidebar end -->

                <div class="main col-md-9">

                    <!-- page-title start -->
                    <!-- ================ -->
                    <h4 class="page-title">使用过程中遇到的问题</h4>
                    <hr><!-- page-title end -->

                    <!-- accordion start -->
                    <div class="panel-group panel-transparent" id="accordion-faq">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" href="#collapseOne" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 账号套餐到期没续费，会怎么样？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>会导致无法收款。请一定记得按时续费。</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" href="#collapse3" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 用户付款成功后，我服务器网络不好，没收到你们的通知，怎么办？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>我们有自动重试通知机制。每隔一分钟，重新通知一次。如果3次后依然没收到通知，请登录我们网站后台，在对应的订单后面，点击“重发通知”按钮即可。</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" href="#collapse4" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 系统代收款订单用户没付款，后来用户主动联系我，自己付款了，怎么办？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>在我们网站后台的订单后面，点“我已收款”即可。这笔订单也不会计手续费的。</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" id="collapse5title" data-parent="#accordion-faq" href="#collapse5" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 微信、支付宝App经常遇到通知延迟，怎么办？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>各个手机的延迟情况原因不同，网上有各种教程。这里有一个终极办法，保证不延迟：</p>
                                    <p>用一台支持分屏功能的旧手机，让支付宝和微信运行在前台，各占一半屏幕。让支付宝和微信的界面都进入设置界面（不要停留在首页，会导致不通知）</p>
                                    <p>WapsPay的App运行在后台，同时设置旧手机永不锁屏，屏幕常亮，并一直充电，放在家里wifi环境中。</p>
                                    <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/help_delay1.jpg') }}"></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" id="collapse6title" data-parent="#accordion-faq" href="#collapse6" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 为什么支付宝收款有回调，微信收款没回调？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>打开微信中的二维码收款语音提醒</p>
                                    <p>在微信【我】 - 【钱包】 - 【收付款】 - 【二维码收款】的右上角...中，开启收款语音提醒。即可有回调。</p>
                                    <p><img src="{{ \Illuminate\Support\Facades\URL::asset('/source/images/appdownload/miui8.jpg') }}"></p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- accordion end -->

                </div>
                <!-- main end -->


            </div>
        </div>
    </section>
    <!-- main-container end -->

@stop

<script type="text/javascript">
    //获取url中的参数
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg); //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
    }

    $().ready(function(){
        var selectid = getUrlParam('selectid');
        if (selectid == "collapse5"){
            $("#collapse5title").removeClass("collapsed");
            $("#collapse5").addClass("in");
        }else if (selectid == "collapseFive"){
            $("#collapseFivetitle").removeClass("collapsed");
            $("#collapseFive").addClass("in");
        }else if (selectid == "collapse6"){
            $("#collapse6title").removeClass("collapsed");
            $("#collapse6").addClass("in");
        }
    });
</script>