@extends('front.layouts.master')

@section('content')
<!-- page-intro start-->
<!-- ================ -->
<div class="page-intro">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><i class="fa fa-home pr-10"></i><a href="index.htm">首页</a></li>
                    <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/user/mySetting'))class="active"@endif>账号设置</li>
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
                    <h4 class="page-title">个人资料</h4>
                    <hr>
                    <div class="form-group">
                        <label for="realname" class="col-md-3 control-label">真实姓名<small class="text-default">*</small></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="realname" id="realname" value="{{ $user->name }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-md-3 control-label">电话<small class="text-default">*</small></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="mobile" id="mobile" value="{{ $user->phone }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="weixin" class="col-md-3 control-label">微信号<small class="text-default">*</small></label>
                        <div class="col-md-9">
                            <input type="text" name="weixin" class="form-control" id="weixin" value="{{ $user->wechat }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="qq" class="col-md-3 control-label">QQ号</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="qq" id="qq" value="{{ $user->qq }}">
                        </div>
                    </div>
                    <!--
                    <div class="space-bottom"></div>

                    <h4 class="page-title">财务资料</h4>
                    <hr>

                    <div class="form-group">
                        <label for="moneyback" class="col-md-3 control-label">余额提现到<small class="text-default">*</small></label>
                        <div class="col-md-9">
                            <select class="form-control" name="moneyback" id="moneyback">
                                <option value="1"  selected>支付宝收款二维码</option>
                                <option value="2" >微信支付收款二维码</option>
                            </select>
                        </div>
                    </div>
                    -->
                    <hr>
                    <p class="text-center"><a href="#" id="btnsave" class="btn btn-default">保存</a></p>
                </form>
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
                $.post(
                    "{{ url('/user/mySetting') }}",
                    {
                        realname:$("#realname").val(),
                        mobile : $("#mobile").val(),
                        weixin : $("#weixin").val(),
                        qq : $("#qq").val(),
                        id : "{{ app('session')->get(\Illuminate\Support\Facades\Config::get('session.user_session_key'))['id'] }}",
                    },
                    function(data){
                        if(data.code > 0){
                            toastr.success(data.msg);
                        } else {
                            toastr.warning(data.msg);
                        }
                    }
                );
            });
        });
    </script>
@stop