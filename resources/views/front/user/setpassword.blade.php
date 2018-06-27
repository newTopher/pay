@extends('front.layouts.master')

@section('content')

<!-- page-intro start-->
<!-- ================ -->
<!-- page-intro start-->
<!-- ================ -->
<div class="page-intro">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><i class="fa fa-home pr-10"></i><a href="/">首页</a></li>
                    <li class="active">修改密码</li>
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
                        <h3 class="title">账号设置</h3>
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

                <!-- page-title end -->
                <form role="form" class="form-horizontal" id="billing-information">
                    <h4 class="page-title">密码修改</h4>
                    <hr>
                    <div class="form-group">
                        <label for="oldpassword" class="col-md-3 control-label">旧密码<small class="text-default">*</small></label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="oldpassword" id="oldpassword" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="newpassword" class="col-md-3 control-label">新密码<small class="text-default">*</small></label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="newpassword" id="newpassword" value="" minlength="8" placeholder="密码至少8位" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="weixin" class="col-md-3 control-label">再输一次新密码<small class="text-default">*</small></label>
                        <div class="col-md-9">
                            <input type="password" name="newpassword1" class="form-control" id="newpassword1" value="" minlength="8" placeholder="密码至少8位" required>
                        </div>
                    </div>

                    <hr>
                    <p class="text-center"><a href="javascript:;" id="btnsave" class="btn btn-default">确定</a></p>
                </form>
                <div class="space-bottom"></div>
                <div class="space-bottom"></div>
                <div class="space-bottom"></div>
                <div class="space-bottom"></div>
                <div class="space-bottom"></div>
                <div class="space-bottom"></div>
                <div class="space-bottom"></div>
            </div>
            <!-- main end -->


        </div>
    </div>
</section>

@stop

@section('scripts')
    <script type="text/javascript">
        $().ready(function(){

            $("#btnsave").click(function(){
                if($("#newpassword").val().length < 8){
                    return toastr.warning('密码长度不能小于 8 个字母');
                }

                if($("#newpassword1").val().length < 8){
                    return toastr.warning('密码长度不能小于 8 个字母');
                }

                $.post(
                    "{{url('/user/mySettingPassword')}}",
                    {
                        oldpassword:$("#oldpassword").val(),
                        newpassword : $("#newpassword").val(),
                        newpassword1 : $("#newpassword1").val(),
                    },
                    function(data){
                        if(data.code > 0){
                            toastr.success(data.msg);
                            $("#oldpassword").val('');
                            $("#newpassword").val('');
                            $("#newpassword1").val('');
                        } else {
                            toastr.warning(data.msg);
                        }
                    }
                );
            });
        });
    </script>

@stop