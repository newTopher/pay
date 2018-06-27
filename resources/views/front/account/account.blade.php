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
                    <li class="active">我的支付账户</li>
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
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-default" id="btnAdd">添加新支付账户</button>
                    </div>
                    <div class="col-md-6">
                        <div class="text-right">
                            <div class="btn-group dropdown">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" onclick="$('#dropdown-menu').show();"><i class="fa fa-edit"></i> 更多操作</button>
                                <ul class="dropdown-menu dropdown-menu-right dropdown-animation" id='dropdown-menu'>

                                    <li><a href="#" onclick="$('#delalipay').modal('show');$('#dropdown-menu').hide();" data-toggle="modal" id="delalipaymodal">删除所有支付宝账号</a></li>
                                    <li><a href="#" onclick="$('#delweixin').modal('show');$('#dropdown-menu').hide();" data-toggle="modal" id="delweixinmodal">清删除所有微信账号</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- page-title start -->
                <!-- ================ -->


                <!-- page-title end -->

                <table class="table cart table-hover table-striped">
                    <thead>
                    <tr>
                        <th>账户名称 </th>
                        <th>类型 </th>
                        <th>是否启用 </th>
                        <th>操作 </th>
                    </tr>
                    </thead>

                        <tbody id="itemTable">

                        <tr id="tr_0" style="display: none;">
                        </tr>
                        @if($account_list)
                        @foreach($account_list as $key=>$val)
                            <tr id="tr_0" class="order-data" goodsid="{{$val->id}}">
                                <td class="product1">
                                    <a class="productEdit">
                                        {{$val->account_name}}
                                    </a>
                                </td>
                                <td class="price1">{{\Illuminate\Support\Facades\Config::get('global.pay_type')[$val->type]}}</td>
                                <td class="qrcode">
                                    @if($val->is_enable)
                                        已启用
                                    @else
                                        未启用
                                    @endif
                                </td>
                                <td class="operate">
                                    @if($val->is_enable)
                                        <a class="btn btn-notification btn-status-switch btn-white" data-status = "{{$val->is_enable}}" data-id="{{$val->id}}">停用</a>
                                    @else
                                        <a class="btn btn-notification btn-status-switch btn-default" data-status = "{{$val->is_enable}}" data-id="{{$val->id}}">启用</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>

                </table>
                <!-- pagination start -->

                <!-- pagination end -->

            </div>

            <!-- 确认删除支付宝二维码 -->
            <div class="modal fade" id="delalipay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" id="usergroup_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel2">确认删除全部支付宝账户？</h4>
                        </div>
                        <div class="modal-body">
                            <p>注意：清空支付账户的时候支付账户里面设置好的商品也将被清空，并且无法恢复！</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="clearAlipay" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-check pr-5"></i>确认清空</button>
                            <button type="button" class="btn btn-sm btn-white" id="group_modal_close" data-dismiss="modal">取消</button>
                        </div>

                    </div>
                </div>
            </div>


            <!-- 确认删除微信二维码 -->
            <div class="modal fade" id="delweixin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" id="usergroup_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel2">确认删除全部微信账户？</h4>
                        </div>
                        <div class="modal-body">
                            <p>注意：清空支付账户的时候支付账户里面设置好的商品也将被清空，并且无法恢复！</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="clearWeixin" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-check pr-5"></i>确认清空</button>
                            <button type="button" class="btn btn-sm btn-white" id="group_modal_close" data-dismiss="modal">取消</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
@stop

@section('scripts')
    @include('front.public.scripts')

    <script type="text/javascript">

        $().ready(function(){
            var trint = 1;  //列数，用来动态添加列


            $('#btntest').click(function(){
                alert(isNaN(".68"));
            });

            $("#btnAdd").click(function(){
                var trHtml = "<tr id='tr_0' class='order-data'>" +
                    "<td class='product1'>" +
                    "<div class='form-group'>" +
                    "<input id='' type='text' class='form-control accounts_name' value='' placeholder='请输入账户名称 如:李晓华'></div>" +
                    "</td>" +
                    "<td class='price1 realprice'>" +
                    "<div class='form-group'><select class='form-control istype'>" +
                    "<option value='{{\Illuminate\Support\Facades\Config::get('global.alipay_pay_type')}}'>支付宝</option>" +
                    "<option value='{{\Illuminate\Support\Facades\Config::get('global.wechat_pay_type')}}'>微信</option>" +
                    "</select></div>" +
                    "</td>" +
                    "<td class='enable1'>" +
                    "<div class='form-group'><select class='form-control is_enable'>" +
                    "<option value='1'>启用</option>" +
                    "<option value='0'>关闭</option>" +
                    "</select></div>" +
                    "</td>" +
                    "<td class='operate'>" +
                    "<a class='btn btn-notification btn-submit-new btn-default'>确定</a> " +
                    "<a class='btn btn-notification btn-cancel-new btn-white'>取消</a>" +
                    "</td>" +
                    "</tr>";
                $("#tr_0").before(trHtml);
                trint = trint + 1;
                $("tr").off("click",".btn-submit-new");

                $("tr").on("click",".btn-cancel-new",function(){
                    $(this).parent().parent().hide();
                });

                $("tr").on("click",".btn-submit-new",function(ee){
                    $.post(
                        "{{url('/user/saveAccount')}}",
                        {
                            account_name:$(this).parent().parent().find(".accounts_name").val(),
                            type:$(this).parent().parent().find(".price1").find(".istype").val(),
                            is_enable:$(this).parent().parent().find(".enable1").find(".is_enable").val()
                        },
                        function(data){
                            if(data.code > 0){
                                toastr.success(data.msg);
                                $(ee.target).parent().parent().find(".product1").html("<a class='productEdit'>"+ data.data.account_name +"</a>");
                                var pay_type_str = '';
                                var pay_enable = '';
                                if(data.data.type =='{{\Illuminate\Support\Facades\Config::get('global.alipay_pay_type')}}'){
                                    pay_type_str = '支付宝';
                                }
                                if(data.data.type =='{{\Illuminate\Support\Facades\Config::get('global.wechat_pay_type')}}'){
                                    pay_type_str = '微信';
                                }

                                if(data.data.is_enable == 1){
                                    pay_enable = '已启用'
                                }else{
                                    pay_enable = '未启用'
                                }
                                $(ee.target).parent().parent().find(".price1").html(pay_type_str);
                                $(ee.target).parent().parent().find(".enable1").html(pay_enable);
                                $(ee.target).parent().parent().find(".operate").html("<a class='btn btn-notification btn-qrcode-upload btn-default'>启用</a>" );
                            } else {
                                toastr.error(data.msg);
                            }
                        }
                    );
                });


            });

            $(".btn-status-switch").on('click',function(){
                var status = $(this).attr('data-status');
                var id = $(this).attr('data-id');
                $.post(
                    "{{url('/user/optAccount')}}",
                    {
                        id:id,
                        is_enable:status
                    },
                    function(data){
                        if(data.code > 0){
                            toastr.success(data.msg);
                            setTimeout(function(){
                                window.location.reload();
                            },1000);
                        } else {
                            toastr.error(data.msg);
                        }
                    }
                );
            });



            function guid() {
                return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                    var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
                    return v.toString(16);
                });
            }

            $(document).on('click', '.popup-modal-dismiss', function (e) {
                e.preventDefault();
                $.magnificPopup.close();
                reload();
                location.reload();
            });

            var get_timestamp = function(){
                var timestamp =0;
                timestamp = Date.parse(new Date());// 获取当前时间戳(以s为单位)
                timestamp = timestamp / 1000;
                return timestamp;
            };


            $("#clearAlipay").click(function(){
                $.post(
                    '{{ url('/user/clearAccount') }}',
                    {
                        type:"{{\Illuminate\Support\Facades\Config::get('global.alipay_pay_type')}}",
                    },
                    function(data){
                        if (data.code > 0){
                            toastr.success(data.msg);
                            setTimeout(function(){
                                window.location.reload();
                            },2000)
                        }else{
                            toastr.warning(data.msg);
                        }
                    }
                );
            });

            $("#clearWeixin").click(function(){
                $.post(
                    '{{ url('/user/clearAccount') }}',
                    {
                        type:"{{\Illuminate\Support\Facades\Config::get('global.wechat_pay_type')}}",
                    },
                    function(data){
                        if (data.code > 0){
                            toastr.success(data.msg);
                            setTimeout(function(){
                                window.location.reload();
                            },2000)
                        }else{
                            toastr.warning(data.msg);
                        }
                    }
                );
            });

            var isedit = 0;
            var goodsid = "";
            var goodsname = "";
            var price ="";
            var oldhtml = "";

            $("tr").off("click",".productEdit");
            $("tr").on("click",".productEdit",function(){
                if (isedit == 0){
                    goodsid = $(this).parent().parent().attr("goodsid");
                    goodsname = trim($(this).text());
                    price = $(this).parent().parent().children(".price1").text();
                    oldhtml = $(this).parent().parent().html();
                    isedit = 1;

                    $(this).parent().parent().html(
                        "<td class='product1'>" +
                        "<div class='form-group'>" +
                        "<input id='' type='text' class='form-control accounts_name' value='"+goodsname+"' placeholder='请输入账户名称 如:李晓华'></div>" +
                        "</td>" +
                        "<td class='price1 realprice'>" +
                        "<div class='form-group'><select class='form-control istype'>" +
                        "<option value='1'>支付宝</option>" +
                        "<option value='2'>微信</option>" +
                        "</select></div>" +
                        "</td>" +
                        "<td class='price1'>" +
                        "<div class='form-group'><select class='form-control is_enable'>" +
                        "<option value='1'>启用</option>" +
                        "<option value='0'>关闭</option>" +
                        "</select></div>" +
                        "</td>" +
                        "<td class='operate'>" +
                        "<a class='btn btn-notification btn-submit-edit btn-default'>确定</a> " +
                        "<a class='btn btn-notification btn-cancel-edit btn-white'>取消</a>" +
                        "</td>"
                    );

                    $("tr").on("click",".btn-cancel-edit",function(){
                        $(this).parent().parent().html(oldhtml);
                        isedit = 0;
                    });

                    $("tr").off("click",".btn-submit-edit");

                    $("tr").on("click",".btn-submit-edit",function(ee){
                        var newgoodsname = $(this).parent().parent().find(".accounts_name").val();
                        var type = $(this).parent().parent().find(".istype").val();
                        var is_enable = $(this).parent().parent().find(".is_enable").val();
                        isedit = 0;
                        $.post(
                            "{{url('/user/saveAccount')}}",
                            {
                                id:goodsid,
                                account_name:newgoodsname,
                                type:type,
                                is_enable:is_enable
                            },
                            function(data){
                                if (data.code > 0){
                                    toastr.success(data.msg);
                                    setTimeout(function(){
                                        location.reload();
                                    }, 2000);

                                }else{
                                    toastr.warning(data.msg);
                                }
                            }
                        );
                    });
                }
            });
        });
    </script>
@stop