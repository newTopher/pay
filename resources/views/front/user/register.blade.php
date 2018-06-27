@extends('front.layouts.master')

@section('content')
<!-- page-intro start-->
<!-- ================ -->
<div class="page-intro">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li><i class="fa fa-home pr-10"></i><a href="index.html" >首页</a></li>
                    <li class="active">注册新账户</li>
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
            <div class="main col-md-6">

                <!-- page-title start -->
                <!-- ================ -->
                <h1 id="forms" class="page-title">注册新账户</h1>

                <br>
                <!-- page-title end -->



                <!-- Forms start -->
                <!-- ============================================================================== -->
                <div id="errorMsg" class="alert alert-danger hidden" role="alert">

                </div>

                <form class="form" role="form" id="registerform">
                    <div class="form-group has-feedback" id="divregEmail">
                        <label class="control-label" for="regEmail">用户名*</label>
                        <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="电子邮箱" required>
                        <i class="fa form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback" id="divinputRealName">
                        <label class="control-label" for="inputRealName">真实姓名*</label>
                        <input type="text" class="form-control" id="inputRealName" name="inputRealName" placeholder="您的真实姓名" required minlength="2" maxlength="20">
                        <i class="fa form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback" id="divinputPassword">
                        <label class="control-label" for="inputPassword">密码*</label>
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="密码" required minlength="8">
                        <i class="fa form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback" id="divinputPassword2">
                        <label class="control-label" for="inputPassword2">重复密码*</label>
                        <input type="password" class="form-control" id="inputPassword2" name="inputPassword2" placeholder="再输入一次密码" minlength="8" equalTo="#inputPassword" required>
                        <i class="fa form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback" id="divinputWeixin">
                        <label class="control-label" for="inputWeixin">微信号*</label>
                        <input type="text" class="form-control" id="inputWeixin" name="inputWeixin" minlength="5" maxlength="20" placeholder="一般问题，微信沟通" required>
                        <i class="fa form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback" id="divinputPhoneNumber">
                        <label class="control-label" for="inputPhoneNumber">紧急联系手机号*</label>
                        <input type="text" class="form-control" id="inputPhoneNumber" name="inputPhoneNumber" placeholder="有安全问题，电话沟通" digits="true" minlength="11" maxlength="11" required>
                        <i class="fa form-control-feedback"></i>
                    </div>

                    <div class="form-group has-feedback" id="divinputPhoneNumber">
                        <label class="control-label" for="inputPhoneNumber"><input type="checkbox" name="inputUserAgree" id="inputUserAgree"  checked="true" />同意*</label>
                        <a href="user_agree.htm"  target="_blank">WapsPay免责声明</a>
                        <i class="fa form-control-feedback"></i>
                    </div>

                    <input type="hidden" id="uuid" name="uuid" value="faa7d36c94cc56a1c2ba56f1">
                    <input type="button" value="注册" class="btn btn-default" id="regButton">

                </form>
                <!-- Forms end -->
            </div>
            <!-- main end -->



        </div>
    </div>
</section>
@stop

@section('scripts')
    <script type="text/javascript">
        $().ready(function(){

            $("#inputUserAgree").change(function(){
                if(this.checked){
                    $("#regButton").attr("disabled",false);
                }else{
                    $("#regButton").attr("disabled",true);
                }
            });

            $("#registerform").validate({

                errorPlacement: function(error, element) {
                    error.appendTo(element.parent());
                },
                highlight: function(element, errorClass) {
                    $(element).parent().addClass("has-error");
                    $(element).parent().children("i").addClass("fa-times");
                    $("#regButton").attr("disabled","true");
                },
                unhighlight: function(element, errorClass) {
                    $(element).parent().removeClass("has-error");
                    $(element).parent().addClass("has-success");
                    $(element).parent().children("i").removeClass("fa-times");
                    $(element).parent().children("i").addClass("fa-check");
                    $("#regButton").removeAttr("disabled");
                    $("#errorMsg").addClass("hidden");
                },
                errorElement: "span",
                messages: {
                    inputPassword2: {
                        required: "请输入密码",
                        minlength: "密码长度不能小于 8 个字母",
                        equalTo: "两次密码输入不一致"
                    },
                    inputPhoneNumber: {
                        minlength: "手机位数不对",
                        maxlength: "手机位数不对"
                    },
                    inputWeixin: {
                        minlength: "微信号长度太短",
                        maxlength: "微信号长度太长"
                    }
                }

            });

            $("#regButton").click(function(){
                $("#regButton").attr("disabled","true");
                $("#regButton").attr("value","请稍后");

                $.post(
                    "/user/register",
                    {
                        inputEmail : $("#inputEmail").val(),
                        inputRealName : $("#inputRealName").val(),
                        inputPassword : $("#inputPassword").val(),
                        inputPassword2 : $("#inputPassword2").val(),
                        inputPhoneNumber : $("#inputPhoneNumber").val(),
                        inputWeixin : $("#inputWeixin").val(),
                    },
                    function(data){
                        $("#regButton").removeAttr("disabled");
                        $("#regButton").attr("value","注册");

                        if(data.code > 0){
                            gtag_report_conversion();
                            toastr.success("<strong>恭喜！</strong>" + data.msg);

                            setTimeout(function(){
                                window.location = data.url;
                            }, 2000);
                        }else{
                            $("#errorMsg").html("<strong>错误：</strong>" + data.msg);
                            $("#errorMsg").removeClass("hidden");
                        }
                    }
                );
            });
        });

    </script>

    @stop

