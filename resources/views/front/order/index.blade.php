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
                    <li class="active">我的订单</li>
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

                <!-- 搜索框开始 -->
                <!-- ================ -->
                <div class="sorting-filters">
                    <form class="form-inline">
                        <div class="form-group">
                            <label>订单号</label>
                            <input type="text" class="form-control" value="{{$request->has('orderid') ? $request->orderid : ''}}" id="inputorderid">
                        </div>
                        <div class="form-group">
                            <label>用户名</label>
                            <input type="text" class="form-control" value="{{$request->has('orderuid') ? $request->orderuid : ''}}" id="inputorderuid">
                        </div>
                        <div class="form-group">
                            <label>实价</label>
                            <input type="text" class="form-control" value="{{$request->has('realprice') ? $request->realprice : ''}}" id="inputrealprice">
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
                        <div class="form-group">
                            <a href="#" id="searchbtn" class="btn btn-default">搜索</a>
                        </div>
                    </form>
                </div>
                <!--搜索框结束 -->

                <table class="table cart table-hover table-striped">
                    <thead>
                    <tr>
                        <th>商品名称 </th>

                        <th>定价 </th>
                        <th>收款账户 </th>
                        <th>创建时间 </th>
                        <th>通知接口 </th>
                        <th class="amount">实价 </th>
                    </tr>
                    </thead>
                    @if($order_list)
                    <tbody>
                        @foreach($order_list as $key=>$val)
                            <tr class="order-data" id="{{$val->id}}">
                                <td class="product"><a href="#" id="more_{{$val->goods_name}}">{{$val->goods_name}}
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
                                    <small>用户名: {{$val->custom_uid}} | 订单号：{{$val->order_id}}</small></td>

                                <td class="price">￥{{number_format($val->price,2)}} <small>手续费:￥{{number_format($val->rate_money,2)}} </small> </td>
                                <td>
                                    {{isset($account_id_map_list[$val['account_id']]) ? $account_id_map_list[$val['account_id']]['account_name'] : '该账户已不存在'}}
                                </td>
                                <td class="quantity">
                                    {{date("Y-m-d H:i:s", $val->create_time)}}
                                </td>
                                @if($val->pay_status == 1)
                                <td class="remove"><a class="btn btn-notification btn-light-gray renotify" data-id= "{{$val->id}}">重发通知</a></td>
                                @endif
                                @if($val->pay_status != 1)
                                    <td class="remove">
                                        <a class="btn btn-notification btn-default hasgetmoney" data-id= "{{$val->id}}" data-toggle="modal" data-target="#hasgetmoneyconfirm">我已收款</a>
                                    </td>
                                @endif
                                <td class="amount">￥{{number_format($val->real_price,2)}}<br />
                                    @if($val->pay_status == 1 && $val->send_status == 1)
                                      已完成
                                     @else
                                        已关闭
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                        @else
                        <tbody>
                          <tr><td colspan="6">暂无订单数据</td></tr>
                        </tbody>
                     @endif
                </table>
                <!-- pagination start -->
                {!! $order_list->links() !!}

                <!-- pagination end -->
                <!-- Modal -->
                <div class="modal fade" id="hasgetmoneyconfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">你确定已收到此用户付款？</h4>
                            </div>
                            <div class="modal-body">
                                <p>一旦确定，我们会立即向您网站发送已收款通知。</p>
                                <p>如果是虚拟商品，买家会立即收到。你确定吗？</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">取消</button>
                                <button type="button" id="btnConfirm" class="btn btn-sm btn-default" data-dismiss="modal">确定</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- main end -->



        </div>
    </div>
</section>
@stop

@section('scripts')
    <script type="text/javascript">
        $().ready(function(){
            var hasgetmoneyid = "";

            $(".hasgetmoney").click(function(){
                hasgetmoneyid = $(this).attr("data-id");
            });

            $("#btnConfirm").click(function(){
                $.post(
                    "{{url('order/hasGetMoney')}}",
                    {
                        id:hasgetmoneyid,
                    },
                    function(data){
                        if (data.code > 0){
                            toastr.success(data.msg);
                            setTimeout(function(){
                                location.reload();
                            }, 2000);
                        }else{
                            toastr.error(data.msg);
                        }
                    }
                );
            });

            $(".renotify").click(function(){
                var paysapi_id = $(this).attr("data-id");

                $.post(
                    "{{url('order/resendNotify')}}",
                    {
                        id : paysapi_id,
                    },
                    function(data){
                        if (data.code > 0){
                            toastr.success(data.msg);
                        }else{
                            toastr.error(data.msg);
                        }
                    }
                );
            });

            $("#searchbtn").click(function(){
                var orderid = $("#inputorderid").val();
                var orderuid = $("#inputorderuid").val();
                var realprice = $("#inputrealprice").val();
                var istype = $("#istype").val();
                var account_id = $("#account_id").val();

                var searchurl = "{{url('/order/myOrder')}}?v=search";
                if (orderid != ""){
                    searchurl = searchurl + "&orderid="+orderid;
                }
                if (orderuid != ""){
                    searchurl = searchurl + "&orderuid="+orderuid;
                }
                if (realprice != ""){
                    searchurl = searchurl + "&realprice="+realprice;
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