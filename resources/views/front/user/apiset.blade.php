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
                        <li class="active">账号设置</li>
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
                        <h4 class="page-title">支付参数设置</h4>
                        <hr>
                        <div class="form-group">
                            <label for="expire_time" class="col-md-3 control-label">二维码过期时间(秒)</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="expire_time" id="expire_time" value="{{$userApiConfigData->qrcode_expire_time}}">
                                <p>请谨慎设置，值越小掉单几率越大。可设置120-600秒之间的值(官方推荐值：360)。值越小，并发数越高，但用户可付款时间越短。达到设定值，二维码会在网页上显示失效。但对已经扫码未付款或保存二维码到手机的用户无效，他们依然可以在失效后付款成功，但会无法回调，导致掉单。</p>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="mobile" class="col-md-3 control-label">支付后，二维码立即可用</label>
                            <div class="col-md-9 checkbox">
                                <label>
                                    <input type="checkbox" value="{{$userApiConfigData->is_paydone_enable}}" @if($userApiConfigData->is_paydone_enable == 1) checked @endif name="isfinish_release" id="isfinish_release">支付后立即可用
                                </label>
                                <p>推荐不勾选，防止因微信支付宝对同一订单重复通知导致的未收款回调(此情况非常少见，但依然有可能遇到。如您的收款手机网络非常好，通知无延迟，可以勾选)。勾选后，用户付完款的二维码会立即释放给下一个人使用。可提升并发数，并尽可能让用户看到整数金额。如不勾选，用户付完款后，此二维码会完整等待一轮二维码过期时间后才释放给下一个客户用。</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="realname" class="col-md-3 control-label">支付页面二维码logo<small class="text-default">*</small></label>
                            <div class="col-md-9">
                                <label>

                                    <img id="upimage" style="width: 50px;height: 50px;border-radius: 50%;border: 1px solid #ccc3c3;@if($userApiConfigData->view_logo) display: block; @else display: none;@endif"  src="{{\Illuminate\Support\Facades\Config::get('global.qiniu_url')."/".$userApiConfigData->view_logo}}" alt="" class="img-rounded">
                                    <input type="hidden" class="form-control" name="view_logo" id="view_logo" placeholder="如：杭州XXX有限公司" value="" required>
                                    <button class="btn btn-default btn-sm" id="btnAdd">上传图片</button>
                                </label>

                                <p>推荐设置，用于在用户支付的显示，增加信任度。</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="realname" class="col-md-3 control-label">支付页面显示名字<small class="text-default">*</small></label>
                            <div class="col-md-9">
                                <label>
                                    <input type="text" class="form-control" name="view_company" id="view_company" placeholder="如：杭州XXX有限公司" value="{{$userApiConfigData->view_company}}" required>
                                </label>
                                <p>推荐设置，用于在用户支付的显示，增加信任度。</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="realname" class="col-md-3 control-label">账户支付模式<small class="text-default">*</small></label>
                            <div class="col-md-9">
                                <label>
                                    <select class="col-md-12 form-control" name="select_type" id="select_type">
                                        <option value="0" @if($userApiConfigData->select_type == 0 ) selected @endif>默认</option>
                                        <option value="1" @if($userApiConfigData->select_type == 1 ) selected @endif>随机</option>
                                        <option value="2" @if($userApiConfigData->select_type == 2 ) selected @endif>轮流</option>
                                    </select>
                                </label>
                                <p>指多个账户的情况下面收款账户收款模式。</p>
                            </div>
                        </div>

                        <hr>
                        <p class="text-center"><a href="#" id="btnsave" class="btn btn-default">保存</a></p>
                    </form>
                </div>
                <!-- main end -->

                <input id="upload" name="file" accept="image/jpg,image/jpeg,image/png" type="file" multiple style="display:none" />

            </div>
        </div>
    </section>

@stop

@section('scripts')
    <script type="text/javascript">
        $().ready(function(){
            var imgFile;
            var currentimg = 0;
            var totalimg = 0;
            var uploadbarstatus = 0;

            $("#btnsave").click(function(){
                var ischeck;
                if ($("#isfinish_release").is(':checked')){
                    ischeck = 1;
                }else{
                    ischeck = 0;
                }
                var view_logo = $("#view_logo").val();
                var view_company = $("#view_company").val();
                var select_type = $("#select_type").val()
                $.post(
                    "{{url('/user/mySettingApiSet')}}",
                    {
                        expire_time:$("#expire_time").val(),
                        isfinish_release : ischeck,
                        view_logo:view_logo,
                        view_company:view_company,
                        select_type:select_type
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

            $("#btnAdd").on("click",function(ee){
                $("#upload").click(); //调用file表单控件上传
            });

            $("#upload").on("change",function(){
                currentimg = 0;
                totalimg = $("#upload")[0].files.length;
                multipleUpload();
            });

            function multipleUpload(){
                var maxsize = 400;
                file = $("#upload")[0].files[currentimg];
                var filesize = $("#upload")[0].files[currentimg].size / 1024;
                //创建读取文件的对象
                if (filesize > maxsize){
                    toastr.error("图片不能超过400Kb");
                    currentimg = currentimg + 1;
                    multipleUpload();
                }else{
                    var reader = new FileReader();
                    reader.addEventListener("loadend", function() {
                        // reader.result contains the contents of blob as a typed array
                        $("#upload")[0].innerText = reader.result;
                    });
                    //为文件读取成功设置事件
                    reader.onloadend=function(e) {
                        imgFile = e.target.result;
                        read(imgFile)
                    };
                    reader.readAsDataURL(file);
                }

            }
            //读取完毕二维码后，执行的函数
            function read(imgFile)
            {
                putb64(imgFile);
            }

            function guid() {
                return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                    var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
                    return v.toString(16);
                });
            }

            function putb64(base64) {
                var pic = base64.replace(/^.*?,/, '');
                var token = "{{$upToken}}";
                // 把字符串转换成json
                function strToJson(str) {
                    var json = eval('(' + str + ')');
                    return json;
                }
                var filename = guid()+".jpg";
                var url = "https://upload-z2.qiniup.com/putb64/-1/key/" + base64encode(filename);
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4) {
                        var keyText = xhr.responseText;
                        // 返回的key是字符串，需要装换成json
                        keyText = strToJson(keyText);
                        //keyText.key 是返回的图片文件名
                        var key = keyText.key;
                        //上传图片名到网站

                        $("#view_logo").val(key);
                        var imgurl = '{{\Illuminate\Support\Facades\Config::get('global.qiniu_url')}}';
                        $("#upimage").attr('src',imgurl + '/'+key);
                        $("#upimage").show();
                    }
                }
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/octet-stream");
                xhr.setRequestHeader("Authorization", "UpToken " + token);
                xhr.send(pic);
            }

            function uploadbarAdd(){
                uploadbarstatus = Math.ceil((currentimg+1) / totalimg * 100);
                $("#uploadbar").attr("aria-valuenow",uploadbarstatus);
                $("#uploadbar").attr("style","width:"+uploadbarstatus+"%");
                $("#uploadbartext").text(uploadbarstatus+"% ("+ (currentimg+1) + "/" + totalimg +")");
            }

            var base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
            var base64DecodeChars = new Array(-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, -1, -1, -1, -1, -1, -1, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -1, -1, -1, -1, -1, -1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1, -1, -1);
            /**
             * base64编码
             * @param {Object} str
             */
            function base64encode(str){
                var out, i, len;
                var c1, c2, c3;
                len = str.length;
                i = 0;
                out = "";
                while (i < len) {
                    c1 = str.charCodeAt(i++) & 0xff;
                    if (i == len) {
                        out += base64EncodeChars.charAt(c1 >> 2);
                        out += base64EncodeChars.charAt((c1 & 0x3) << 4);
                        out += "==";
                        break;
                    }
                    c2 = str.charCodeAt(i++);
                    if (i == len) {
                        out += base64EncodeChars.charAt(c1 >> 2);
                        out += base64EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
                        out += base64EncodeChars.charAt((c2 & 0xF) << 2);
                        out += "=";
                        break;
                    }
                    c3 = str.charCodeAt(i++);
                    out += base64EncodeChars.charAt(c1 >> 2);
                    out += base64EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
                    out += base64EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >> 6));
                    out += base64EncodeChars.charAt(c3 & 0x3F);
                }
                return out;
            }

        });
    </script>
@stop