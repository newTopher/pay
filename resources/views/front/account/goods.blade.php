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
                        <li class="active">我的商品</li>
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
                <div class="main col-md-12">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <strong>初始商品表</strong> 您可以选择最优方案一键快捷初始化商品价格表
                    </div>
                </div>

                <!-- main start -->
                <!-- ================ -->
                <div class="main col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <select class="account_id" style="width: 160px;text-indent:8px;height: 42px;line-height: 42px;position: relative;top: 2px;">
                                <option value="">请先选择支付账户</option>
                                @if($account_list)
                                    @foreach($account_list as $key=>$val)
                                        <option is_wx="{{$val['is_wx']}}" is_alipay="{{$val['is_alipay']}}" value="{{$val['id']}}">{{$val['account_name']}}</option>
                                    @endforeach
                                    @else
                                    暂无账户请先添加
                                @endif
                            </select>
                            <button class="btn btn-warning" onclick="$('#goodsinit').modal('show');$('#dropdown-menu').hide();" data-toggle="modal" id="goodsinitmodal">快速初始化价格表</button>
                            <button class="btn btn-default" id="btnAdd">添加新商品</button>
                            <button class="btn btn-default btn-qrcode-upload" id="btnAddQrcode">批量上传二维码</button>
                        </div>
                        <div class="col-md-4">
                            <div class="text-right">
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" onclick="$('#dropdown-menu').show();"><i class="fa fa-edit"></i> 更多操作</button>
                                    <ul class="dropdown-menu dropdown-menu-right dropdown-animation" id='dropdown-menu'>

                                        <li><a href="#" onclick="$('#delalipay').modal('show');$('#dropdown-menu').hide();" data-toggle="modal" id="delalipaymodal">清空支付宝二维码</a></li>
                                        <li><a href="#" onclick="$('#delweixin').modal('show');$('#dropdown-menu').hide();" data-toggle="modal" id="delweixinmodal">清空微信二维码</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- page-title start -->
                    <!-- ================ -->


                    <!-- page-title end -->
                    <button class="btn btn-default btn-qrcode-upload" id="btntest" style="display:none">test</button>
                    <a class="popup-modal" id="showbar" href="#test-modal" style="display:none">Open modal</a>

                    <input id="upload" name="file" accept="image/jpg,image/jpeg,image/png" type="file" multiple style="display:none" />
                    <img id="imgContent">
                    <div id="test-modal" class="white-popup-block mfp-hide">
                        <p class="text-center" id='show_upload_image_title'>温馨提示：一次上传，数量不限，尽可能一次传一批。</p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success progress-bar-striped active" id="uploadbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                <span class="sr-only" id="uploadbartext">0% (0/0)</span>
                            </div>
                        </div>
                        <p class="text-center"><a class="btn btn-white popup-modal-dismiss" href="#">取消上传</a></p>
                    </div>

                    <table class="table cart table-hover table-striped">
                        <thead>
                        <tr>
                            <th>商品名称 </th>
                            <th>定价 </th>
                            <th>所属账户 </th>
                            <th>二维码数量 </th>
                            <th>操作 </th>
                        </tr>
                        </thead>

                            <tbody id="itemTable">

                            <tr id="tr_system" class="order-data" style="display: none;">
                                <td class="product1">
                                    <a href="#">[重要]该账户自动匹配价格的商品(需用户自己输入金额)
                                        <i class="iconfont iconfont-umidd17 pr-5"></i>
                                        <i class="iconfont iconfont-pay-wechat pr-5"></i>
                                    </a>
                                    <small>
                                        <span class="is_wx_text"></span>
                                        | <span class="is_wx_alipay"></span>
                                    </small>
                                </td>
                                <td class="price1">任意金额</td>
                                <td class="account1"></td>
                                <td class="qrcode">
                                    <a class="is_wx_a_text" href="#">

                                    </a><br>
                                    <a class="is_alipay_a_text" href="#">

                                    </a>
                                </td>
                                <td class="operate">
                                </td>
                            </tr>
                            <tr id="tr_0" style="display: none;">
                            </tr>
                            @if($goods_list)
                            @foreach($goods_list as $key=>$val)
                                <tr id="tr_0" class="order-data" goodsid="{{$val['id']}}">
                                    <td class="product1"><a class="productEdit">{{$val['product_name']}}</a>
                                        <small>
                                            @if($val['a_i_loss_arr'])
                                            支付宝缺：@foreach($val['a_i_loss_arr'] as $k=>$v)￥{{ number_format($v,2) }}@endforeach
                                            @endif
                                                @if($val['a_i_loss_arr'] || $val['w_i_loss_arr'])   |   @endif
                                            @if($val['w_i_loss_arr'])
                                            微信缺：@foreach($val['w_i_loss_arr'] as $k=>$v)￥{{ number_format($v,2) }}@endforeach
                                            @endif
                                        </small>
                                    </td>
                                    <td class="price1">￥{{ number_format($val['money'],2)}}</td>
                                    <td class="account1">{{$account_id_map_list[$val['account_id']]['account_name']}}</td>
                                    <td class="qrcode">最佳：支付宝
                                        <a href="#" class="pt-popover" data-toggle="popover" data-placement="right" data-content="@foreach($val['a_i_well_arr'] as $k=>$v)￥{{$v}} &nbsp;@endforeach" title="" data-original-title="存在最佳支付宝二维码">{{$val['a_i_well']}}个</a>，微信
                                        <a href="#" class="pt-popover" data-toggle="popover" data-placement="right" data-content="@foreach($val['w_i_well_arr'] as $k=>$v)￥{{$v}} &nbsp;@endforeach" title="" data-original-title="存在最佳微信二维码">{{$val['w_i_well']}}个</a>
                                        <br>可用：支付宝
                                        <a href="#" class="pt-popover" data-toggle="popover" data-placement="right" data-content="@foreach($val['a_i_arr'] as $k=>$v)￥{{$v}} &nbsp;@endforeach" title="" data-original-title="存在可用支付宝二维码">{{$val['a_i']}}个</a>，微信
                                        <a href="#" class="pt-popover" data-toggle="popover" data-placement="right" data-content="@foreach($val['w_i_arr'] as $k=>$v)￥{{$v}} &nbsp;@endforeach" title="" data-original-title="存在可用微信二维码">{{$val['w_i']}}个</a></td>
                                    <td class="operate"><a class="btn btn-notification btn-qrcode-upload btn-default" account-id = "{{$val['account_id']}}">上传二维码</a></td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>

                    </table>

                    <!-- pagination start -->

                    <!-- pagination end -->

                </div>
                <!-- main end -->


                <!-- 确认删除支付宝二维码 -->
                <div class="modal fade" id="delalipay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" id="usergroup_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel2">确认删除全部支付宝二维码？</h4>
                            </div>
                            <div class="modal-body">
                                <p>注意：清空后无法恢复！</p>
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
                                <h4 class="modal-title" id="myModalLabel2">确认删除全部微信二维码？</h4>
                            </div>
                            <div class="modal-body">
                                <p>注意：清空后无法恢复！</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="clearWeixin" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-check pr-5"></i>确认清空</button>
                                <button type="button" class="btn btn-sm btn-white" id="group_modal_close" data-dismiss="modal">取消</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 确认初始化价格表 -->
                <div class="modal fade" id="goodsinit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" id="usergroup_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel2">请选择需要初始化的价格表方案</h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-info alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    这里可以快速生成商品价格表,后期可以根据需要再自主添加其余价格
                                </div>
                                请选择
                                <ul class="nav nav-justified tab_switch_pad">
                                    <li class="is_active"><a href="#">低</a></li>
                                    <li><a href="#">中</a></li>
                                    <li><a href="#">高</a></li>
                                </ul>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="badge">需上传  (¥9.99,¥10,¥10.01)  3  个二维码</span>
                                        ¥10
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge">14</span>
                                        ¥20
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge">14</span>
                                        ¥50
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge">14</span>
                                        ¥100
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge">14</span>
                                        ¥200
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge">14</span>
                                        ¥300
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge">14</span>
                                        ¥500
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge">14</span>
                                        ¥800
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge">14</span>
                                        ¥1000
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge">14</span>
                                        ¥2000
                                    </li>
                                </ul>
                                <span>总计上传 10 个二维码 <a href="#">下载需上传的二维码表格</a> </span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="clearAlipay" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-check pr-5"></i>一键生成</button>
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
            //设置识别的二位码函数
            qrcode.callback = read;
            var trint = 1;  //列数，用来动态添加列
            //二维码识别值
            var qrstr;
            //创建文件读取相关的变量
            var imgFile;
            var currentimg = 0;
            var totalimg = 0;
            var uploadbarstatus = 0;

            // $('#delalipaymod,al').click(function(){
            //     $('#delalipay').modal('show');
            // });
            // $('#delweixinmodal').click(function(){
            //     $('#delweixin').modal('show');
            // });


            $('#btntest').click(function(){
                alert(isNaN(".68"));
            });

            $(".account_id").change(function(){
                var account_name = $(this).find("option:selected").text();
                var is_wx = $(this).find("option:selected").attr('is_wx');
                var is_alipay = $(this).find("option:selected").attr('is_alipay');
                if(is_alipay == 1) {
                    $("#tr_system .is_wx_alipay").text("已支持支付宝自定义金额收款");
                    $("#tr_system .is_wx_a_text").text("已支持支付宝");
                }else{
                    $("#tr_system .is_wx_alipay").text("请上传支付宝收款不设金额二维码1张");
                    $("#tr_system .is_wx_a_text").text("未支持支付宝自定义金额收款");
                }
                if(is_wx == 1) {
                    $("#tr_system .is_wx_text").text("已支持微信支付自定义金额收款");
                    $("#tr_system .is_alipay_a_text").text("已支持微信支付");
                }else{
                    $("#tr_system .is_wx_text").text("请上传微信支付收款不设金额二维码1张");
                    $("#tr_system .is_alipay_a_text").text("未支持微信支付自定义金额收款");
                }
                $("#tr_system").show();
                $("#tr_system .account1").text(account_name);
            });

            $("#btnAdd").click(function(){
                var account_id = $(".account_id").val();
                var account_name = $(".account_id").find("option:selected").text();
                if(!account_id){
                    toastr.error('请先选择支付账户或者添加新的支付账户再添加商品');
                    return;
                }
                var trHtml = "<tr id='tr_0' class='order-data'>" +
                    "<td class='product1'>" +
                    "<div class='form-group'>" +
                    "<input id='' type='text' class='form-control goodsname' value='' placeholder='新商品名称'>" +
                    "</div>" +
                    "</td>" +
                    "<td class='price1 realprice'>" +
                    "<div class='form-group'>" +
                    "<input type='text' class='form-control goodsprice' placeholder='例如:10.00'>" +
                    "</div></td>"+
                    "<td class='account1 account_name' data-id='"+account_id+"'>" +
                    "<div class='form-group'>" +account_name +
                    "</div></td>"+
                    "<td class='qrcode'>最佳：支付宝 " +
                    "<a href='#' class='pt-popover' data-toggle='popover' data-placement='right' data-content='' title='' data-original-title='存在最佳支付宝二维码'>0个</a>" +
                    "，微信 <a href='#' class='pt-popover' data-toggle='popover' data-placement='right' data-content='' title='' data-original-title='存在最佳微信二维码'>0个</a>" +
                    " <br>可用：支付宝 <a href='#' class='pt-popover' data-toggle='popover' data-placement='right' data-content='' title='' data-original-title='存在可用支付宝二维码'>0个</a>" +
                    "，微信 <a href='#' class='pt-popover' data-toggle='popover' data-placement='right' data-content='' title='' data-original-title='存在可用微信二维码'>0个</a></td>"+
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
                    $("tr").off("click",".btn-qrcode-upload");
                    $("tr").on("click",".btn-qrcode-upload",function(ee){
                        $("#upload").click(); //调用file表单控件上传
                        $("#upload").on("change",function(){
                            currentimg = 0;
                            totalimg = $("#upload")[0].files.length;
                            multipleUpload();
                        });
                    });

                    $.post(
                        "{{ url('/user/addgoods') }}",
                        {
                            goodsName:$(this).parent().parent().find(".goodsname").val(),
                            goodsPrice:$(this).parent().parent().find(".goodsprice").val(),
                            account_id:$(this).parent().parent().find(".account1").attr('data-id')
                        },
                        function(data){
                            if(data.code > 0){
                                $("body").data('account-id',account_id);
                                toastr.success(data.msg);
                                $(ee.target).parent().parent().find(".product1").html("<a href='#'>"+ data.data.product_name +"</a><small>需刷新界面，看对应二维码状态</small>");
                                $(ee.target).parent().parent().find(".realprice").html("￥"+ (data.data.money));
                                $(ee.target).parent().parent().find(".operate").html("<a class='btn btn-notification btn-qrcode-upload btn-default ' account-id = '"+data.data.account_id+"'>上传二维码</a>");
                            } else {
                                toastr.error(data.msg);
                            }
                        }
                    );
                });
            });

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

                        $.ajax({
                            type: 'post',
                            url: "{{ url('/user/addqrcode') }}",
                            data:{
                                qrstr:qrstr,
                                imgname:key,
                                account_id:$("body").data('account-id')
                            },
                            success: function (data) {
                                if (data.code > 0){
                                    $("#show_upload_image_title").text(data.msg);
                                    toastr.success(data.msg);
                                    uploadbarAdd();
                                    currentimg = currentimg + 1;
                                    if (currentimg < totalimg){
                                        multipleUpload();
                                    }else{
                                        setTimeout(function(){
                                            location.reload();
                                        }, 2000);
                                    }
                                } else {
                                    $("#show_upload_image_title").text(data.msg);
                                    toastr.warning(data.msg);
                                    return;
                                    uploadbarAdd();
                                    currentimg = currentimg + 1;
                                    if (currentimg < totalimg){
                                        multipleUpload();
                                    }else{
                                        setTimeout(function(){
                                            location.reload();
                                        }, 2000);
                                    }

                                }
                            },
                            error: function (data) {
                                toastr.error("上传出错一张，重试中");
                                //currentimg = currentimg + 1;
                                if (currentimg < totalimg){
                                    multipleUpload();
                                }else{
                                    setTimeout(function(){
                                        location.reload();
                                    }, 2000);
                                }
                            }
                        })
                    }
                }
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/octet-stream");
                xhr.setRequestHeader("Authorization", "UpToken " + token);
                xhr.send(pic);
            }

            $("tr").on("click",".btn-qrcode-upload",function(ee){
                $("body").data('account-id',$(this).attr('account-id'))
                $("#upload").click(); //调用file表单控件上传

            });

            $("#btnAddQrcode").click(function(){
                var account_id = $(".account_id").val();
                if(!account_id){
                    toastr.error('请先选择支付账户或者添加新的支付账号再添加二维码');
                    return;
                }
                $("body").data('account-id',account_id)
                $("#upload").click(); //调用file表单控件上传
            });

            $("#upload").on("change",function(){
                currentimg = 0;
                totalimg = $("#upload")[0].files.length;
                $("#showbar").click();
                multipleUpload();
            });

            function multipleUpload(){
                var maxsize = 400;

                file = $("#upload")[0].files[currentimg];
                var filesize = $("#upload")[0].files[currentimg].size / 1024;
                //创建读取文件的对象
                if (filesize > maxsize){
                    toastr.error("图片不能超过400Kb，请使用截图或者点保存下来的二维码");
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
                        qrcode.decode(imgFile);
                        //通过base64编码字符流计算文件流大小函数
                    };
                    //正式读取文件
                    reader.readAsDataURL(file);
                }

            }

            var isfromwwei;

            //读取完毕二维码后，执行的函数
            function read(a)
            {
                qrstr = a;
                var tempstr = qrstr.toLowerCase();
                if (tempstr.indexOf('alipay')>=0 || tempstr.indexOf('wxp://')>=0){
                    //上传到七牛云
                    putb64(imgFile);
                }else{
                    //尝试wwei接口，如果依然失败，再返回错误
                    if (isfromwwei == 1){
                        toastr.warning("图片必须是支付宝、微信的收款二维码截图或保存的文件");
                        isfromwwei = 0;
                    }else{
                        getwweicode(imgFile);
                    }

                }
            }

            function reload(){
                qrstr = '';
                imgFile = '';
                currentimg = 0;
                totalimg = 0;

                var file = $("#upload");
                file.after(file.clone().val(""));
                file.remove();
            }

            function uploadbarAdd(){
                uploadbarstatus = Math.ceil((currentimg+1) / totalimg * 100);
                $("#uploadbar").attr("aria-valuenow",uploadbarstatus);
                $("#uploadbar").attr("style","width:"+uploadbarstatus+"%");
                $("#uploadbartext").text(uploadbarstatus+"% ("+ (currentimg+1) + "/" + totalimg +")");
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

            function getwweicode(imgdata){  // imgdata = base64_encode_image('./qrcode.jpg');//本地图片
                isfromwwei = 1;
                //config
                var api_id = 'qr241778';
                var api_key = '20171027135609';
                var timestamp = get_timestamp();
                var client = hprose.Client.create('https://rpcapi.wwei.cn/qrcode.html', ['qrencode','qrdecode']);

                var imgurl = '';//远程图片
                //var imgdata ='';// base64_encode_image('./qrcode.jpg');//本地图片

                var signature = md5(api_key + timestamp + imgurl +　imgdata);
                client.ready(function(qrcode) {
                    qrcode.qrdecode(api_id,signature,timestamp,imgurl,imgdata)
                        .then(function(result) {
                            if(result.status !=1){
                                toastr.error("二维码无法识别，请换一张");
                                currentimg = currentimg + 1;
                                if (currentimg < totalimg){
                                    multipleUpload();
                                }else{
                                    setTimeout(function(){
                                        location.reload();
                                    }, 2000);
                                }
                            }
                            //成功
                            read(result.data.raw_text);

                        },function(e) {
                            toastr.error("二维码无法识别：" + e);
                            currentimg = currentimg + 1;
                            if (currentimg < totalimg){
                                multipleUpload();
                            }else{
                                setTimeout(function(){
                                    location.reload();
                                }, 2000);
                            }
                        });
                });
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

            $("#clearAlipay").click(function(){
                $.post(
                    '{{ url('/user/clearQrcode') }}',
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
                    '{{ url('/user/clearQrcode') }}',
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
            var account_id = '';
            var account_name = '';
            var oldhtml = "";

            $("tr").off("click",".productEdit");
            $("tr").on("click",".productEdit",function(){
                if (isedit == 0){
                    goodsid = $(this).parent().parent().attr("goodsid");
                    goodsname = trim($(this).text());
                    price = $(this).parent().parent().children(".price1").text();
                    oldhtml = $(this).parent().parent().html();
                    account_id = $(this).parent().parent().children(".account1").attr('account_id');
                    account_name = $(this).parent().parent().children(".account1").html();
                    isedit = 1;
                    price = price.replace("￥","");

                    $(this).parent().parent().html("" +
                        "<td class='product1'>" +
                        "<div class='form-group'>" +
                        "<input id='' type='text' class='form-control goodsname' value='"+goodsname+"'>" +
                        "</div>" +
                        "</td>" +
                        "<td class='price1 realprice'>" +
                        "<div class='form-group'>" +
                        "<input type='text' class='form-control goodsprice' value='"+price+"'>" +
                        "</div>" +
                        "</td>" +
                        "<td class='account1 account_name' data-id='"+account_id+"'>" +
                        "<div class='form-group'>" +account_name +
                        "</div></td>"+
                        "<td class='qrcode'>" +
                        "</td>" +
                        "<td class='operate'>" +
                        "<a class='btn btn-notification btn-submit-edit btn-default'>确定</a> " +
                        "<a class='btn btn-notification btn-cancel-edit btn-white'>取消</a>" +
                        "</td>");


                    $("tr").on("click",".btn-cancel-edit",function(){
                        $(this).parent().parent().html(oldhtml);
                        isedit = 0;
                    });

                    $("tr").off("click",".btn-submit-edit");

                    $("tr").on("click",".btn-submit-edit",function(ee){
                        var newgoodsname = $(this).parent().parent().find("input.goodsname").val();
                        var newprice = $(this).parent().parent().find("input.goodsprice").val();
                        //alert(goodsid);
                        isedit = 0;
                        $.post(
                            "{{ url('/user/addgoods') }}",
                            {
                                id:goodsid,
                                goodsName:newgoodsname,
                                goodsPrice:newprice
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