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
                    <li class="active">无匹配订单收款</li>
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

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-12">

                <!-- page-title start -->
                <!-- ================ -->

                <!-- page-title end -->
                <!-- search start-->
                <div class="sorting-filters">
                    <form class="form-inline">
                        <div class="form-group">
                            <label>金额</label>
                            <input type="text" class="form-control" value="{{$request->has('money') ? $request->money : ''}}" id="money">
                        </div>

                        <div class="form-group">
                            <label>账户</label>
                            <select class="form-control" id="account_id">
                                <option value="">请先选择支付账户</option>
                                @if($account_list)
                                    @foreach($account_list as $key=>$val)
                                        <option value="{{$val['id']}}" @if($request->has('account_id') && $request->account_id == $val['id'])
                                        selected
                                                @endif>{{$val['account_name']}}</option>
                                    @endforeach
                                @else
                                    暂无账户请先添加
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>收款通道</label>
                            <select class="form-control" id="istype">
                                <option value="" @if($request->has('istype') && $request->istype == "")
                                selected
                                        @endif>全部</option>
                                <option  value="1" @if($request->has('istype') && $request->istype ==1)
                                selected
                                        @endif>支付宝</option>
                                <option  value="2" @if($request->has('istype') && $request->istype ==2)
                                selected
                                        @endif>微信</option>
                            </select>
                        </div>
                        <div class="form-group"  type="hidden"></div>

                        <div class="form-group">
                            <label></label>
                            <a href="#" id="searchbtn" class="btn btn-default">搜索</a>
                        </div>
                    </form>
                </div>
                <!-- search end-->
                <!-- tabs start -->
                <div class="tabs-style-2">
                    <table class="table cart table-hover table-striped">
                        <thead>
                        <tr>
                            <th>无匹配订单收款</th>
                            <th>收款账户 </th>
                            <th>收款通知时间 </th>
                            <th class="amount">收到金额</th>
                        </tr>
                        </thead>
                        @if($order_list)
                        <tbody>
                            @foreach($order_list as $key=>$val)
                                <tr id="{{$val->id}}">
                                    <td ><a href="#" id="more_{{$val->order_id}}">{{$val->order_id}}
                                            @if($val->pay_type == \Illuminate\Support\Facades\Config::get('global.alipay_pay_type'))
                                                <i title="支付宝支付" class="iconfont iconfont-umidd17 pr-5"></i>
                                            @endif
                                            @if($val->pay_type == \Illuminate\Support\Facades\Config::get('global.wechat_pay_type'))
                                                <i title="微信支付" class="fa fa-wechat pr-5"></i>
                                            @endif
                                            @if($val->pay_status == 1)
                                                <i title="已支付" class="iconfont iconfont-yiwancheng1 pr-5"></i>
                                            @endif
                                            @if($val->pay_status != 1)
                                                <i title="超时未支付，已关闭" class="iconfont iconfont-unfinished pr-5"></i>
                                            @endif

                                        </a>
                                    </td>
                                    <td>
                                        {{isset($account_id_map_list[$val['account_id']]) ? $account_id_map_list[$val['account_id']]['account_name'] : '该账户已不存在'}}
                                    </td>
                                    <td>
                                        {{date("Y-m-d H:i:s", $val->app_pay_time)}}
                                    </td>
                                    <td class="amount">
                                        ￥{{number_format($val->price,2)}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @else
                            <tbody>
                            <tr><td colspan="5">暂无订单数据</td></tr>
                            </tbody>
                        @endif
                    </table>
                    <!-- pagination start -->
                     {!! $order_list->links() !!}
                    <!-- pagination end -->
                </div>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong>有4种情况可能匹配不到订单：</strong> 1.有人向您收款二维码直接转账，没走支付接口（可能是朋友，也可能是老客户）。
                    2.用户用支付宝微信扫码后未及时支付，在订单超时后才回来支付，此时订单已关闭。(解决方案：如此情况较多，请在设置中适当延长二维码过期时间)
                    3.任意金额二维码收款时，用户输错金额，导致订单匹配不上。(解决方案：多上传定额收款二维码，尽量覆盖用户可能用到的金额)
                    4.手机通知延迟到订单超时（<a href="{{\Illuminate\Support\Facades\Config::get('global.site_url')}}/faqused?selectid=collapse5">解决方案</a>）。
                    支付宝微信的重复通知，也会在这里留下记录。（解决方案：请勿在多台手机安装APP并登录同一个账号，同时确保手机网络通畅。）
                </div>
            </div>


            <!-- main end -->
        </div>
    </div>
</section>
<!-- main-container end -->
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#searchbtn").click(function(){
                var money = $("#money").val();
                var istype = $("#istype").val();
                var account_id = $("#account_id").val();
                var searchurl = "{{url('/order/myNoOrder')}}?v=search";

                if (money != ""){
                    searchurl = searchurl + "&money="+money;
                }
                if (istype != ""){
                    searchurl = searchurl + "&istype="+istype;
                }
                if (account_id != ""){
                    searchurl = searchurl + "&account_id="+account_id;
                }
                location.href = searchurl;
            });
        });
    </script>
@stop