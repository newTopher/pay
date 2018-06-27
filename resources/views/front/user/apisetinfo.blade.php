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
                        <li class="active">API接口信息</li>
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
                        <h4 class="page-title">接口信息</h4>
                        <hr>
                        <div class="form-group">
                            <label for="uid" class="col-md-3 control-label">Uid</label>
                            <div class="col-md-9">
                                <label for="uidshow" class="control-label">{{$userApiConfigData->api_key}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="billingemail" class="col-md-3 control-label">Token</label>
                            <div class="col-md-9">
                                <label for="token" id="token" class="control-label">{{$userApiConfigData->api_token}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="billingemail" class="col-md-3 control-label">重置</label>
                            <div class="col-md-9">
                                <a href="#" class="btn btn-white btn-sm" data-toggle="modal" data-target="#myModal">
                                    重置Token
                                </a>
                            </div>
                        </div>
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
                    </form>
                </div>
                <!-- main end -->
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">确定要重置Token吗？</h4>
                            </div>
                            <div class="modal-body">
                                <p>重置后，请立即修改您网站上的对应的token值，不然会导致接口无法使用。</p>
                                <p>建议在晚上较少人使用的情况下重置。</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">取消</button>
                                <button type="button" id="resetToken" class="btn btn-sm btn-default" data-dismiss="modal">确认重置</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('scripts')
    <script type="text/javascript">
        $().ready(function(){
            $("#resetToken").click(function(){
                $.post(
                    "{{url('user/mySettingApiSetInfo')}}",
                    "",
                    function(data){
                        if(data.code > 0){
                            toastr.success(data.msg);
                            setTimeout(function () {
                                window.location.reload();
                            },1000)
                        } else {
                            toastr.warning(data.msg);
                        }
                    }
                );
            });


        });
    </script>
@stop