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
                    <li class="active">所有会员</li>
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

                <!-- search start-->
                <div class="sorting-filters">
                    <form class="form-inline">
                        <div class="form-group">
                            <label>账号</label>
                            <input type="text" class="form-control" value="{{$request->has('email') ? $request->email : ''}}" id="email">
                        </div>

                        <div class="form-group">
                            <label>手机号</label>
                            <input type="text" class="form-control" value="{{$request->has('phone') ? $request->email : ''}}" id="phone">
                        </div>

                        <div class="form-group">
                            <label>用户类型</label>
                            <select class="form-control" id="role_type">
                                <option value="" @if($request->has('role_type') && $request->role_type == 0)
                                selected
                                        @endif>全部</option>
                                <option  value="1" @if($request->has('role_type') && $request->role_type ==1)
                                selected
                                        @endif>普通用户</option>
                                <option  value="2" @if($request->has('role_type') && $request->role_type ==2)
                                selected
                                        @endif>代理商</option>
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

                <table class="table cart table-hover table-striped">
                    <thead>
                    <tr>
                        <th>账号 </th>
                        <th>名字 </th>
                        <th>用户类型 </th>
                        <th>手机号码 </th>
                        <th>操作 </th>
                    </tr>
                    </thead>
                    @if($userList)
                        <tbody id="itemTable">
                        @foreach($userList as $key=>$val)
                            <tr class="order-data" user_id="{{$val->id}}">
                                <td class="product1">
                                    <a class="productEdit">
                                        {{$val->email}}
                                    </a>
                                </td>
                                <td>
                                    {{$val->name}}
                                </td>
                                <td class="price1">{{\Illuminate\Support\Facades\Config::get('global.user_type')[$val->role_type]}}</td>
                                <td class="qrcode">
                                    {{$val->phone}}
                                </td>
                                <td class="operate">
                                    <a class="btn btn-notification btn-status-switch btn-white" data-id="{{$val->id}}">设为代理商</a>
                                    <a class="btn btn-notification btn-status-switch btn-white" data-id="{{$val->id}}">禁用</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    @else
                        <tbody>
                        <tr><td colspan="5">暂无数据</td></tr>
                        </tbody>
                    @endif

                </table>
                <!-- pagination start -->
                        {!! $userList->links() !!}
                <!-- pagination end -->

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

        $(document).ready(function(){
            $("#searchbtn").click(function(){
                var email = $("#email").val();
                var phone = $("#phone").val();
                var role_type = $("#role_type").val();
                var searchurl = "{{url('/user/allUsers')}}?v=search";

                if (email != ""){
                    searchurl = searchurl + "&email="+email;
                }
                if (phone != ""){
                    searchurl = searchurl + "&phone="+phone;
                }
                if (role_type != ""){
                    searchurl = searchurl + "&role_type="+role_type;
                }
                location.href = searchurl;
            });
        });
    </script>
@stop