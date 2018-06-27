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
                    <li class="active">我的套餐</li>
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
                        <h3 class="title">套餐信息</h3>
                        <div class="separator"></div>
                        @include('front.public.setting_nav')
                    </div>
                </div>
            </aside>
            <!-- sidebar end -->

            <!-- main start -->
            <!-- ================ -->
            <div class="main col-md-8 col-md-offset-1">

                <!-- page-title start -->
                <!-- ================ -->
                @if($mealdata)
                    <!-- page-title end -->
                    <h4 class="page-title">套餐信息</h4>
                    <hr>
                    <form role="form" class="form-horizontal" id="billing-information">

                        <div class="form-group">
                            <table class="table table-striped">

                                <tbody>
                                <tr>

                                    <td>套餐名称</td>
                                    <td>                                                    专业版套餐
                                    </td>
                                </tr>
                                <tr>

                                    <td>开始时间</td>
                                    <td>2018-03-22 20:31:52</td>
                                </tr>
                                <tr>

                                    <td>到期时间</td>
                                    <td>2018-05-22 20:31:52</td>
                                </tr>
                                <tr>

                                    <td>剩余天数</td>
                                    <td>12天</td>
                                </tr>
                                </tbody>
                            </table>
                            <p class="text-center"><a href="#" id="group3" class="btn btn-default group_id">续费</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="#" class="btn btn-primary group_upgrade">更改套餐</a></p>
                        </div>

                    </form>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                </div>
                <!-- main end -->
            @else
                <!-- main start -->
                <!-- ================ -->
                <div class="main col-md-8 col-md-offset-1">

                    <!-- page-title start -->
                    <!-- ================ -->

                    <!-- page-title end -->
                    <h4 class="page-title">套餐信息</h4>
                    <hr>
                    <div class="form-group">尚未购买套餐，回<a href="{{ url('/index/index') }}">首页</a>购买</div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                </div>
                <!-- main end -->
            @endif

            <!-- 会员续费Modal -->
            <div class="modal fade" id="usergroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" id="usergroup_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel2">套餐续费</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped showgroup_id" id="">
                                <tbody>
                                <tr>
                                    <td>套餐名称</td>
                                    <td id="showgroup_name">基础版 - 0.3%手续费</td>
                                </tr>
                                <tr>

                                    <td>套餐价格</td>
                                    <td id="showgroup_price">29.99元/月</td>
                                </tr>
                                <tr>
                                    <td>续费时长</td>
                                    <td id="showgroup_longtime">
                                        <select class="col-md-6 form-control" id="longtimeselect">
                                            <option value="1">1个月</option>
                                            <option value="6">6个月 - 8.8折</option>
                                            <option value="12">1年 - 8.3折</option>
                                            <option value="24">2年 - 7折</option>
                                            <option value="36">3年 - 5折</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>起始时间</td>
                                    <td id="showgroup_begintime">123123123123</td>
                                </tr>
                                <tr>

                                    <td>到期时间</td>
                                    <td id="showgroup_endtime">13123123232132</td>
                                </tr>
                                <tr>
                                    <td><strong>总价:</strong></td>
                                    <td id ="showgroup_totalprice"><strong>￥195.00</strong> &nbsp;<span class="text-muted">原价：<del>248.54</del></span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center text-muted"><h6>- 您的账户信息 -</h6></td>
                                </tr>
                                <tr>
                                    <td>您账户余额：</td>
                                    <td id="money_left"><strong>￥226.06</strong>&nbsp;&nbsp; <a href="/myCounter" target="_blank"><i class="fa fa-question-circle pr-5"></i>如余额不足，请先充值</a></td>
                                </tr>
                                <tr>

                                    <td>登录密码</td>
                                    <td id="showgroup_password"><input type="password" class="form-control" id="groupPassword" name="groupPassword" placeholder="请输入登录密码" required minlength="8">
                                        <i class="fa form-control-feedback"></i></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <button type="button" id="sumit_group" class="btn btn-default" data-dismiss="modal1"><i class="fa fa-check pr-5"></i>续费</button>
                            <button type="button" class="btn btn-sm btn-default" id="group_modal_close" style="display:none;" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 会员升级Modal -->
            <div class="modal fade" id="groupupgrade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel3">套餐升级</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped groupupgrade_id" id="">
                                <tbody>
                                <tr>
                                    <td>套餐升级到</td>
                                    <td id="groupupgrade_name">
                                        <select class="col-md-6 form-control" id="groupidselect">
                                            <option value="1" >基础版套餐</option>
                                            <option value="2" >高级版套餐</option>
                                            <option value="3" selected>专业版套餐(当前)</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>起始时间</td>
                                    <td id="groupupgrade_begintime">2018-05-10 15:31:27</td>
                                </tr>
                                <tr>

                                    <td>到期时间</td>
                                    <td id="groupupgrade_endtime">2018-05-22 20:31:52</td>
                                </tr>
                                <tr>
                                    <td><strong>需补差价:</strong></td>
                                    <td id ="groupupgrade_totalprice"><strong>￥0.00</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center text-muted"><h6>- 您的账户信息 -</h6></td>
                                </tr>
                                <tr>
                                    <td>您账户余额：</td>
                                    <td id="money_left"><strong>￥226.06</strong>&nbsp;&nbsp; <a href="/myCounter" target="_blank"><i class="fa fa-question-circle pr-5"></i>如余额不足，请先充值</a></td>
                                </tr>
                                <tr>

                                    <td>登录密码</td>
                                    <td id="groupupgrade_password"><input type="password" class="form-control" id="groupupgradePassword" name="groupupgradePassword" placeholder="请输入登录密码" required minlength="8">
                                        <i class="fa form-control-feedback"></i></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <p class="text-danger">注：降级套餐不会补差价，如再升级需重新补差价，请谨慎操作。</p>
                            <button type="button" id="sumit_groupupgrade" class="btn btn-default" data-dismiss="modal1"><i class="fa fa-check pr-5"></i>付款</button>
                            <button type="button" class="btn btn-sm btn-default" id="groupupgrade_modal_close" style="display:none;" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 自动续费Modal -->
            <div class="modal fade" id="cancel_auto_renew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">你确定要关闭自动续费功能吗？</h4>
                        </div>
                        <div class="modal-body">
                            <p>关闭之后将不再自动续费套餐。</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">取消</button>
                            <button type="button" id="cancel_btn" class="btn btn-sm btn-default" data-dismiss="modal">确定</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="auto_renew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">点击确定开启自动续费功能</h4>
                        </div>
                        <div class="modal-body">
                            <p>你的套餐将自动续费。</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">取消</button>
                            <button type="button" id="renew_btn" class="btn btn-sm btn-default" data-dismiss="modal">确定</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<button class="btn-default btn" data-toggle="modal" data-target="#usergroup" style="display:none;"  id="showgroupmodal">显示套餐信息</button>
<button class="btn-default btn" data-toggle="modal" data-target="#groupupgrade" style="display:none;"  id="showgroupupgrademodal">显示升级信息</button>

@stop

@section('scripts')
    <script type="text/javascript">
        $().ready(function(){
            $(".group_id").click(function(){
                $('#longtimeselect').val("1");
                if ($(this).attr('id') == 'group1'){
                    $('.showgroup_id').attr('id','group1');
                    $('#showgroup_name').text("基础版套餐");
                    $('#showgroup_price').text("29.99元/月");
                    $('#showgroup_begintime').text("2018-05-22");
                    $('#showgroup_endtime').text("2018-06-22");
                    $('#showgroup_totalprice').html('<strong>￥'+29.99+'</strong>');
                } else {
                    if ($(this).attr('id') == 'group2'){
                        $('.showgroup_id').attr('id','group2');
                        $('#showgroup_name').text("高级版套餐");
                        $('#showgroup_price').text("59.99元/月");
                        $('#showgroup_begintime').text("2018-05-22");
                        $('#showgroup_endtime').text("2018-06-22");
                        $('#showgroup_totalprice').html('<strong>￥'+59.99+'</strong>');
                    }else{
                        if ($(this).attr('id') == 'group3'){
                            $('.showgroup_id').attr('id','group3');
                            $('#showgroup_name').text("专业版套餐");
                            $('#showgroup_price').text("99.99元/月");
                            $('#showgroup_begintime').text("2018-05-22");
                            $('#showgroup_endtime').text("2018-06-22");
                            $('#showgroup_totalprice').html('<strong>￥'+99.99+'</strong>');
                        }
                    }
                }
                $('#showgroupmodal').click();
            });

            $("#longtimeselect").change(function(){
                if ($('.showgroup_id').attr('id') == 'group1'){
                    switch($('#longtimeselect').val()){
                        case "1":
                            $('#showgroup_endtime').text("2018-06-22");
                            $('#showgroup_totalprice').html('<strong>￥'+29.99+'</strong>');
                            break;
                        case "6":
                            $('#showgroup_endtime').text("2018-11-22");
                            $('#showgroup_totalprice').html('<strong>￥'+158.35+'</strong> &nbsp;<span class="text-muted">原价：<del>'+179.95+'</del></span>');
                            break;
                        case "12":
                            $('#showgroup_endtime').text("2019-05-22");
                            $('#showgroup_totalprice').html('<strong>￥'+298.7+'</strong> &nbsp;<span class="text-muted">原价：<del>'+359.88+'</del></span>');
                            break;
                        case "24":
                            $('#showgroup_endtime').text("2020-05-22");
                            $('#showgroup_totalprice').html('<strong>￥'+503.83+'</strong> &nbsp;<span class="text-muted">原价：<del>'+719.76+'</del></span>');
                            break;
                        case "36":
                            $('#showgroup_endtime').text("2021-05-22");
                            $('#showgroup_totalprice').html('<strong>￥'+539.82+'</strong> &nbsp;<span class="text-muted">原价：<del>'+1079.64+'</del></span>');
                            break;
                        default:
                            $('#showgroup_endtime').text("2018-06-22");
                            $('#showgroup_totalprice').html('<strong>￥'+29.99+'</strong>');
                    }
                }
                if ($('.showgroup_id').attr('id') == 'group2'){
                    switch($('#longtimeselect').val()){
                        case "1":
                            $('#showgroup_endtime').text("2018-06-22");
                            $('#showgroup_totalprice').html('<strong>￥'+59.99+'</strong>');
                            break;
                        case "6":
                            $('#showgroup_endtime').text("2018-11-22");
                            $('#showgroup_totalprice').html('<strong>￥'+316.75+'</strong> &nbsp;<span class="text-muted">原价：<del>'+359.95+'</del></span>');
                            break;
                        case "12":
                            $('#showgroup_endtime').text("2019-05-22");
                            $('#showgroup_totalprice').html('<strong>￥'+597.5+'</strong> &nbsp;<span class="text-muted">原价：<del>'+719.88+'</del></span>');
                            break;
                        case "24":
                            $('#showgroup_endtime').text("2020-05-22");
                            $('#showgroup_totalprice').html('<strong>￥'+1007.83+'</strong> &nbsp;<span class="text-muted">原价：<del>'+1439.76+'</del></span>');
                            break;
                        case "36":
                            $('#showgroup_endtime').text("2021-05-22");
                            $('#showgroup_totalprice').html('<strong>￥'+1079.82+'</strong> &nbsp;<span class="text-muted">原价：<del>'+2159.64+'</del></span>');
                            break;
                        default:
                            $('#showgroup_endtime').text("2018-06-22");
                            $('#showgroup_totalprice').html('<strong>￥'+59.99+'</strong>');
                    }
                }
                if ($('.showgroup_id').attr('id') == 'group3'){
                    switch($('#longtimeselect').val()){
                        case "1":
                            $('#showgroup_endtime').text("2018-06-22");
                            $('#showgroup_totalprice').html('<strong>￥'+99.99+'</strong>');
                            break;
                        case "6":
                            $('#showgroup_endtime').text("2018-11-22");
                            $('#showgroup_totalprice').html('<strong>￥'+527.95+'</strong> &nbsp;<span class="text-muted">原价：<del>'+599.95+'</del></span>');
                            break;
                        case "12":
                            $('#showgroup_endtime').text("2019-05-22");
                            $('#showgroup_totalprice').html('<strong>￥'+983.9+'</strong> &nbsp;<span class="text-muted">原价：<del>'+1199.88+'</del></span>');
                            break;
                        case "24":
                            $('#showgroup_endtime').text("2020-05-22");
                            $('#showgroup_totalprice').html('<strong>￥'+1679.83+'</strong> &nbsp;<span class="text-muted">原价：<del>'+2399.76+'</del></span>');
                            break;
                        case "36":
                            $('#showgroup_endtime').text("2021-05-22");
                            $('#showgroup_totalprice').html('<strong>￥'+1799.82+'</strong> &nbsp;<span class="text-muted">原价：<del>'+3599.64+'</del></span>');
                            break;
                        default:
                            $('#showgroup_endtime').text("2018-06-22");
                            $('#showgroup_totalprice').html('<strong>￥'+99.99+'</strong>');
                    }
                }
            });


            $("#sumit_group").click(function(){
                $("#sumit_group").attr("disabled","true");
                $.post(
                    "/manageGroup_renew",
                    {
                        group_id : $(".showgroup_id").attr('id'),
                        longtimeselect : $('#longtimeselect').val(),
                        password : $("#groupPassword").val(),

                    },
                    function(data){
                        $("#sumit_group").removeAttr("disabled");
                        if (data.code > 0){
                            toastr.success(data.msg);
                            setTimeout(function(){
                                location.reload();
                            }, 2000);
                            $('#group_modal_close').click();

                        } else {
                            toastr.warning(data.msg);
                        }
                    }
                );
            });

            var upgrade_day = "12";
            $(".group_upgrade").click(function(){
                $('#showgroupupgrademodal').click();
            });

            $("#groupidselect").change(function(){
                if (3 == 1 && $("#groupidselect").val() == 2){
                    $('#groupupgrade_totalprice').html('<strong>￥'+ toDecimal2(upgrade_day * 0) +'</strong>');
                } else if (3 == 1 && $("#groupidselect").val() == 3){
                    $('#groupupgrade_totalprice').html('<strong>￥'+ toDecimal2(upgrade_day * 0) +'</strong>');
                } else if (3 == 2 && $("#groupidselect").val() == 3){
                    $('#groupupgrade_totalprice').html('<strong>￥'+ toDecimal2(upgrade_day * 0) +'</strong>');
                } else {
                    $('#groupupgrade_totalprice').html('<strong>￥0.00</strong>');
                }
            });


            $("#sumit_groupupgrade").click(function(){
                $("#sumit_groupupgrade").attr("disabled","true");
                $.post(
                    "/manageGroup_upgrade",
                    {
                        group_id : "group"+$("#groupidselect").val(),
                        password : $("#groupupgradePassword").val(),

                    },
                    function(data){
                        $("#sumit_groupupgrade").removeAttr("disabled");
                        if (data.code > 0){
                            toastr.success(data.msg);
                            $('#groupupgrade_modal_close').click();
                            setTimeout(function(){
                                location.reload();
                            }, 2000);

                        } else {
                            toastr.warning(data.msg);
                        }
                    }
                );
            });

            //判断自动续费功能是否开启，来决定调用的方法
            if ($("#input_renew").is(":checked")) {
                $("#input_renew").click(function () {
                    if ($("#input_renew").is(":checked")) {
                        $(".group_renew").attr("disabled","true");
                    } else {
                        $(".group_renew").removeAttr("disabled");
                        $(".group_renew").attr("data-target","#cancel_auto_renew");
                    }
                });
            } else {
                $("#input_renew").click(function () {
                    if ($("#input_renew").is(":checked")) {
                        $(".group_renew").removeAttr("disabled");
                        $(".group_renew").attr("data-target","#auto_renew");
                    } else {
                        $(".group_renew").attr("disabled","true");
                    }
                });
            }

            //开启自动续费
            $("#renew_btn").click( function () {
                $.post(
                    "/auto_renew",
                    function (data) {
                        if (data.code > 0) {
                            toastr.success(data.msg);
                            setTimeout(function(){
                                location.reload();
                            }, 1000);
                        }
                    }
                );
            });

            //关闭自动续费
            $("#cancel_btn").click( function () {
                $.post(
                    "/cancel_auto_renew",
                    function (data) {
                        if (data.code > 0) {
                            toastr.success(data.msg);
                            setTimeout(function(){
                                location.reload();
                            }, 1000);
                        }
                    }
                );
            });
        })
    </script>

@stop