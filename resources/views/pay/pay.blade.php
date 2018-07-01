<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{{\Illuminate\Support\Facades\Config::get('global.pay_type')[$data['pay_type']]}} - {{\Illuminate\Support\Facades\Config::get('global.site_title')}}</title>
    <link href="{{ \Illuminate\Support\Facades\URL::asset('/pay_source/pay1.css') }}" rel="stylesheet" media="screen">
    <script type="text/javascript" src="{{ \Illuminate\Support\Facades\URL::asset('/pay_source/jquery.min.js') }}"></script>
</head>

<body>
<div class="body">
    <h1 class="mod-title">
        <span class="ico_log ico-{{$data['pay_type']}}"></span>
    </h1>

    <div class="mod-ct">

        <div class="common-pay-month">
            <div class="common-pay-list-month">
                <span class="year-openmonth" data-month="12">请选择您所需要的充值的金额 </span>
                <ul class="common-pay-select-month common-pay-bgcolor-svip">
                    <li class="common-pay-input-month-num checked">￥10</li>
                    <li class="common-pay-input-month-num">￥20</li>
                    <li class="common-pay-input-month-num">￥50</li>
                    <li class="common-pay-input-month-num">￥100</li>
                </ul>

                <ul class="common-pay-select-month common-pay-bgcolor-svip">
                    <li class="common-pay-input-month-num">￥150</li>
                    <li class="common-pay-input-month-num">￥200</li>
                    <li class="common-pay-input-month-num">￥300</li>
                    <li class="common-pay-input-month-num">￥500</li>
                </ul>

                <ul class="common-pay-select-month common-pay-bgcolor-svip">
                    <li class="common-pay-input-month-num">￥600</li>
                    <li class="common-pay-input-month-num">￥800</li>
                    <li class="common-pay-input-month-num">￥900</li>
                    <li class="common-pay-input-month-num">￥1000</li>
                </ul>
            </div>
        </div>

    </div>

    <div class="mod-ct">

        <div class="common-pay-month">
            <div class="common-pay-list-month">
                <ul class="common-pay-select-month common-pay-bgcolor-svip">
                    <li class="common-pay-input-month-num checked">￥1200</li>
                    <li class="common-pay-input-month-num">￥1500</li>
                    <li class="common-pay-input-month-num">￥2000</li>
                    <li class="common-pay-input-month-num">￥2500</li>
                </ul>

                <ul class="common-pay-select-month common-pay-bgcolor-svip">
                    <li class="common-pay-input-month-num">￥3000</li>
                    <li class="common-pay-input-month-num">￥4000</li>
                    <li class="common-pay-input-month-num">￥5000</li>
                    <li class="common-pay-input-month-num">￥6000</li>
                </ul>

                <ul class="common-pay-select-month common-pay-bgcolor-svip">
                    <li class="common-pay-input-month-num">￥7000</li>
                    <li class="common-pay-input-month-num">￥8000</li>
                    <li class="common-pay-input-month-num">￥9000</li>
                    <li class="common-pay-input-month-num">￥10000</li>
                </ul>
            </div>
        </div>

    </div>


    <div class="mod-ct">

        <div class="common-pay-month">
            <div class="common-pay-list-month">
                <ul class="common-pay-select-month common-pay-bgcolor-svip">
                    <li class="common-pay-input-month-num checked">￥15000</li>
                    <li class="common-pay-input-month-num">￥20000</li>
                    <li class="common-pay-input-month-num">￥40000</li>
                    <li class="common-pay-input-month-num">￥50000</li>
                </ul>

                <ul class="common-pay-select-month common-pay-bgcolor-svip">
                    <li class="common-pay-input-month-num">￥60000</li>
                    <li class="common-pay-input-month-num">￥80000</li>
                    <li class="common-pay-input-month-num">￥90000</li>
                    <li class="common-pay-input-month-num">￥100000</li>
                </ul>
            </div>
        </div>

    </div>



</div>




<script src="{{ \Illuminate\Support\Facades\URL::asset('/pay_source/jquery.qrcode.min.js') }}"></script>
<script type="text/javascript">

    var myTimer;
    var strcode = "{{$data['qrstr']}}";

    function timer(intDiff) {
        myTimer = window.setInterval(function () {
            var day = 0,
                hour = 0,
                minute = 0,
                second = 0;//时间默认值
            if (intDiff > 0) {
                day = Math.floor(intDiff / (60 * 60 * 24));
                hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
                minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
                second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
            }
            if (minute <= 9) minute = '0' + minute;
            if (second <= 9) second = '0' + second;
            $('#hour_show').html('<s id="h"></s>' + hour + '时');
            $('#minute_show').html('<s></s>' + minute + '分');
            $('#second_show').html('<s></s>' + second + '秒');
            if (hour <= 0 && minute <= 0 && second <= 0) {
                qrcode_timeout();
                clearInterval(myTimer);
            }
            intDiff--;

            if (strcode != ""){
                checkdata();
            }

        }, 2000);
    }

    function checkdata(){
        $.post(
            "{{url('pay/getresult')}}",
            {
                wapsapi_id :"{{$data['order_id']}}" ,
            },
            function(data){
                if (data.code > 0){
                    window.clearInterval(timer);
                    $("#show_qrcode").attr("src","{{ \Illuminate\Support\Facades\URL::asset('/pay_source/pay_ok.png') }}");
                    $("#use").remove();
                    $("#money").text("支付成功");
                    $("#msg").html("<h1>即将返回商家页</h1>");
                    if (isMobile() == 1){
                        $(".paybtn").html('<a href="' + data.url + '" class="btn btn-primary">返回商家页</a>');
                        setTimeout(function(){
                            // window.location = data.url;
                            location.replace(data.url)
                        }, 3000);
                    }else{
                        $("#msg").html("<h1>即将<a href='{{$data['return_url']}}?orderid={{$data['order_id']}}'>跳转</a>回商家页</h1>");
                        setTimeout(function(){
                            // window.location = data.url;
                            location.replace(data.url)
                        }, 3000);
                    }

                }
            },
            'json'
        );
    }

    function qrcode_timeout(){
        $('#show_qrcode').attr("src","{{ \Illuminate\Support\Facades\URL::asset('/pay_source/qrcode_timeout.png') }}");
        $("#use").hide();
        $('#msg').html("<h1>请刷新本页</h1>");

    }

    function isWeixin() {
        var ua = window.navigator.userAgent.toLowerCase();
        if (ua.match(/MicroMessenger/i) == 'micromessenger') {
            return 1;
        } else {
            return 0;
        }
    }

    function isMobile() {
        var ua = navigator.userAgent.toLowerCase();
        _long_matches = 'googlebot-mobile|android|avantgo|blackberry|blazer|elaine|hiptop|ip(hone|od)|kindle|midp|mmp|mobile|o2|opera mini|palm( os)?|pda|plucker|pocket|psp|smartphone|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce; (iemobile|ppc)|xiino|maemo|fennec';
        _long_matches = new RegExp(_long_matches);
        _short_matches = '1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-';
        _short_matches = new RegExp(_short_matches);
        if (_long_matches.test(ua)) {
            return 1;
        }
        user_agent = ua.substring(0, 4);
        if (_short_matches.test(user_agent)) {
            return 1;
        }
        return 0;
    }
    //本地生成二维码
    function showCodeImage(){
        var qrcode = $('#qrcode').qrcode({
            text: '{{$data['qrstr']}}',
            width: 200,
            height: 200,
        }).hide();
        //添加文字  
        var outTime = '过期时间：{{date("Y-m-d H:i:s",$show_expire_time)}}';//过期时间
        var canvas = qrcode.find('canvas').get(0);
        var oldCtx = canvas.getContext('2d');
        var imgCanvas = document.getElementById('imgCanvas');
        var ctx = imgCanvas.getContext('2d');
        ctx.fillStyle = 'white';
        ctx.fillRect(0,0,310,270);
        ctx.putImageData(oldCtx.getImageData(0, 0, 200, 200), 55, 28);
        //ctx.stroke = 3;  
        ctx.textBaseline = 'middle';
        ctx.textAlign = 'center';
        ctx.font ="15px Arial";
        ctx.fillStyle = '#00c800';
        ctx.strokeStyle = '#00c800'
        ctx.fillText(outTime, imgCanvas.width / 2, 242 );
        ctx.strokeText(outTime, imgCanvas.width / 2, 242);

        var about = '过期后请勿支付，不自动到账';
        ctx.fillText(about, imgCanvas.width / 2, 260 );
        ctx.strokeText(about, imgCanvas.width / 2, 260);

        if("{{$data['self_money']}}"==1){
            ctx.fillStyle = 'red';
            ctx.strokeStyle = 'red'
            var about = '请支付 {{$data['price']}} 元,否则不能自动到账';
            ctx.fillText(about, imgCanvas.width / 2, 10 );
            ctx.strokeText(about, imgCanvas.width / 2, 10);
        }
        imgCanvas.style.display = 'none';
        $('#show_qrcode').attr('src', imgCanvas.toDataURL('image/png')).css({
            width: 310,height:270
        });
        // $('#downloadbtn').attr('href', imgCanvas.toDataURL('image/png'));
    }

    $().ready(function(){
        //默认6分钟过期
        timer("{{$expire_time}}");
        var pay_type = "{{$data['pay_type']}}";
        var suremoney = "{{$data['self_money']}}";
        var uaa = navigator.userAgent;
        var isiOS = !!uaa.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
        if (isMobile() == 1){
            if (isWeixin() == 1 && pay_type == 2){
                //微信内置浏览器+微信支付
                $("#showtext").text("长按二维码识别");
            } else{
                //其他手机浏览器+支付宝支付
                if (isWeixin() == 0 && pay_type == 1){
                    $(".paybtn").attr('style','');
                    var goPay = '<span id="goPay"> <span>';
                    //给A标签中的文字添加一个能被jQuery捕获的元素
                    $('#alipaybtn').append(goPay);
                    //模拟点击A标签中的文字
                    $('#goPay').click();

                    $('#msg').html("<h1>支付完成后，请返回此页</h1>");
                    $(".qrcode-img-wrapper").remove();
                    $(".tip").remove();
                    $(".foot").remove();

                    //$(location).attr('href', 'HTTPS://QR.ALIPAY.COM/FKX02984ZYSSKZMXL9VNA4');
                } else {
                    if (isWeixin() == 0 && pay_type == 2){
                        //其他手机浏览器+微信支付
                        //IOS的排除掉
                        if (isiOS){
                            // showCodeImage();

                            $('.iospayweixinbtn').attr('style','padding-top: 15px;');
                        }else{
                            $(".payweixinbtn").attr('style','padding-top: 15px;');
                        }
                        $("#showtext").html("请保存二维码到手机<br>微信扫一扫点右上角-从相册选取");
                    }
                }
            }
        }


        if (isiOS){
            $('#show_qrcode').css({width: 310,height:310});
        }else{
            var show_expire_time = '{{$show_expire_time}}';
            if(show_expire_time!='0'){
                if (document.getElementById("imgCanvas").getContext){
                    try {
                        showCodeImage();
                    } catch (error) {
                        $('#show_qrcode').attr('src', "https://pan.baidu.com/share/qrcode?w=210&h=210&url={{$data['qrstr']}}");
                    }
                }else{
                    $('#show_qrcode').attr('src', "https://pan.baidu.com/share/qrcode?w=210&h=210&url={{$data['qrstr']}}");
                    // $('#downloadbtn').attr('href', "https://pan.baidu.com/share/qrcode?w=210&h=210&url=HTTPS://QR.ALIPAY.COM/FKX02984ZYSSKZMXL9VNA4");
                }
            }else{
                $('#show_qrcode').attr('src', "https://pan.baidu.com/share/qrcode?w=210&h=210&url={{$data['qrstr']}}");
                // $('#downloadbtn').attr('href', "https://pan.baidu.com/share/qrcode?w=210&h=210&url=HTTPS://QR.ALIPAY.COM/FKX02984ZYSSKZMXL9VNA4");
            }
        }

    });

</script>
</body>
</html>