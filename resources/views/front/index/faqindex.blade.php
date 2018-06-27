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

                <!-- main start -->
                <!-- ================ -->
                <div class="main col-md-9">

                    <!-- page-title start -->
                    <!-- ================ -->
                    <h4 class="page-title">常见接入问题解答</h4>
                    <hr><!-- page-title end -->

                    <!-- accordion start -->
                    <div class="panel-group panel-transparent" id="accordion-faq">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" href="#collapseOne" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 接入WapsPay后，我的支付宝微信账号是否安全？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>非常安全。懂一点安卓技术的同学都知道，我们应用没有要求Root权限，也不需要在App中输入支付宝、微信的账号密码。所以我们从物理上就不存在获取您支付宝、微信账号密码、盗取秘钥的可能。</p>
                                    <p>同时，我们强烈建议：不要在非官方App、官网以外的任何网站、APP中输入账号密码，否则极可能账号被盗、资金丢失。</p>
                                    <p>我们强烈建议您不要Root手机，有Root权限的App，可以拿到您支付宝微信支付的秘钥，随意生成二维码，非常危险。</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" href="#collapseTwo" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> WapsPay的“你敢用，我敢赔”保障金是什么？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>敢赔保证金是我们提供给大家的另一重保障。</p>
                                    <p>因为我们对我们的安全非常自信。所以我们敢做出承诺：保证整个支付流程安全、您支付宝微信账号密码安全。只要是因为WapsPay导致的账号被盗、资金丢失的情况，我们一律按承诺赔偿。</p>
                                    <p>您网站因自身安全问题导致的损失不在赔偿范围内，不过如遇到此情况，请联系我们客服。我们会第一时间处理并尽可能帮您挽回损失。</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" href="#collapseThree" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 使用WapsPay会不会导致我支付宝、微信账号被封号？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>不会。因为用WapsPay的商户的支付宝微信账户和普通个人账号没有任何区别。</p>
                                    <p>我们既不会不断刷新您的支付宝后台，也不存在任何可能拿到您账号密码，异地登录等异常行为，更做不到模拟支付宝微信App和支付宝微信服务端交互。</p>
                                    <p>我们把可能会给您账号带来风险的因素都考虑到了，所以使用WapsPay是安全的。</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" href="#collapse4" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 用户付款是经过网站账号中转，还是直接付款到我自己的支付宝微信账号？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>是直接付款到您支付宝微信账号的。您在网站首页体验的流程就是未来您用户付费的流程，在您接入后，您的用户是直接扫描您的二维码付款的。</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" href="#collapse5" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 用户直接付款到我账户，你们平台怎么扣手续费？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>您需要在后台充值一些余额。不用多，够支付手续费的就可以。</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" href="#collapse6" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 为什么一定要安装App？如果我没运行App，会有什么后果？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>如果您手机App未运行，用户依然会付款给您，钱依然会直接到您支付宝微信余额中，但是就不会有回调了。用户会来找您并提供付款截图，您确认后，可以在我们APP的订单后台，根据接口传入的用户名，订单号，支付金额找到对应订单，并点击“我已收款”，系统会立即通知到您的回调接口。好消息是：手动收款是免手续费的。</p>
                                    <p>我们强烈建议您用一台旧手机安装上我们的App放在家里的wifi环境中，并保持永不锁屏，一直充电的状态。如遇到微信支付宝不通知或者延迟，请看这里的<a href="/faqused?selectid=collapse5">解决方案</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" href="#collapseFour" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 安装手机App后，需要做哪些设置？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>1.需要登录WapsPay账号。</p>
                                    <p>2.其他设置项，<a href="/app_miui">请看这里</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" href="#collapse7" id="collapse7title" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 我不懂技术，也找不到人帮我接入，怎么办？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse7" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>联系客服，客服帮您找人接入，根据您的接入工作量复杂程度，会收取800-1200左右的接入费用。</p>
                                    <p>或者您可以自行在猪八戒等威客网站找团队接入。</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-faq" href="#collapse8" class="collapsed">
                                        <i class="fa fa-question-circle pr-10"></i> 支付页是否可以自定义界面？
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse8" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>可以。如果您设计的支付页很棒，您可以自己设计制作支付页模板，做成HTML页后联系客服，客服审核通过后由我们研发制作成通用模板上架。不过您得同意上架的模板需无偿提供给所有商户供选择使用。</p>
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
        if (selectid == "collapse7"){
            $("#collapse7title").removeClass("collapsed");
            $("#collapse7").addClass("in");
        }else if (selectid == "collapseFive"){
            $("#collapseFivetitle").removeClass("collapsed");
            $("#collapseFive").addClass("in");
        }
    });
</script>