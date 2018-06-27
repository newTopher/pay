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
                        <li class="active">API接入文档</li>
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
                            <h3 class="title">API接入文档</h3>
                            <div class="separator"></div>
                            @include('front.public.apidoc_nav')
                        </div>
                    </div>
                </aside>
                <!-- sidebar end -->

                <!-- main start -->
                <!-- ================ -->
                <div class="main col-md-9">

                    <!-- page-title start -->
                    <!-- ================ -->
                    <h4 class="page-title">发起付款接口(必用接口)</h4>
                    <hr>
                    <!-- page-title end -->
                    <p>有2种方法发起支付：1.获取json支付页信息，自定义支付页；2.跳转到我们支付页</p>

                    <h5>获取支付json数据接口URL：<span style="color:red;">(强烈推荐,防止我们域名出问题时影响业务)</span></h5>
                    <pre>https://pay.bbbapi.com/?format=json</pre>
                    <h5>传参方式：Post</h5>
                    <p>说明：用curl的post方式传参数，并直接获取json返回值，显示在您自定义的支付页上。</p>
                    <hr>

                    <h5>跳转支付页接口URL：</h5>
                    <pre>https://pay.bbbapi.com/</pre>
                    <h5>传参方式：Post</h5>
                    <p>使用方法：用表单post的方式，post参数并跳转到此网址，显示我们的支付页。</p>
                    <hr>



                    <h5>请求参数：</h5>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>参数名</th>
                            <th>含义</th>
                            <th>类型</th>
                            <th>说明</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><small>uid</small></td>
                            <td><small>商户uid</small></td>
                            <td><small>string(24)</small></td>
                            <td><small>必填。您的商户唯一标识，注册后在设置里获得。一个24位字符串</small></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><small>price</small></td>
                            <td><small>价格</small></td>
                            <td><small>float</small></td>
                            <td><small>必填。单位：元。精确小数点后2位</small></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><small>istype</small></td>
                            <td><small>支付渠道</small></td>
                            <td><small>int</small></td>
                            <td><small>必填。1：支付宝；2：微信支付</small></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><small>notify_url</small></td>
                            <td><small>通知回调网址</small></td>
                            <td><small>string(255)</small></td>
                            <td><small>必填。用户支付成功后，我们服务器会主动发送一个post消息到这个网址。由您自定义。不要urlencode。例：http://www.aaa.com/paysapi_notify</small></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><small>return_url</small></td>
                            <td><small>跳转网址</small></td>
                            <td><small>string(255)</small></td>
                            <td><small>必填。用户支付成功后，我们会让用户浏览器自动跳转到这个网址。由您自定义。不要urlencode。例：http://www.aaa.com/paysapi_return</small></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td><small>orderid</small></td>
                            <td><small>商户自定义订单号</small></td>
                            <td><small>string(50)</small></td>
                            <td><small>必填。我们会据此判别是同一笔订单还是新订单。我们回调时，会带上这个参数。例：201710192541</small></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td><small>orderuid</small></td>
                            <td><small>商户自定义客户号</small></td>
                            <td><small>string(100)</small></td>
                            <td><small>选填。我们会显示在您后台的订单列表中，方便您看到是哪个用户的付款，方便后台对账。强烈建议填写。可以填用户名，也可以填您数据库中的用户uid。例：xxx, xxx@aaa.com</small></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td><small>goodsname</small></td>
                            <td><small>商品名称</small></td>
                            <td><small>string(100)</small></td>
                            <td><small>选填。您的商品名称，用来显示在后台的订单名称。如未设置，我们会使用后台商品管理中对应的商品名称</small></td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td><small>key</small></td>
                            <td><small>秘钥</small></td>
                            <td><small>string(32)</small></td>
                            <td><small>必填。把使用到的所有参数，<strong>连Token一起</strong>，按<mark>参数名</mark>字母升序排序。把<mark>参数值</mark>拼接在一起。做md5-32位加密，取字符串小写。得到key。网址类型的参数值不要urlencode。</small></td>
                        </tr>
                        </tbody>
                    </table>
                    <p>key的拼接顺序：如用到了所有参数，就按这个顺序拼接：goodsname + istype + notify_url + orderid + orderuid + price + return_url + token + uid</p>
                    <p class="text-danger"><strong>注意：Token在安全上非常重要，一定不要显示在任何网页代码、网址参数中。只可以放在服务端。计算key时，先在服务端计算好，把计算出来的key传出来。严禁在客户端计算key，严禁在客户端存储Token。</strong></p>
                    <h5>Json请求的返回值：</h5>
                    <pre>
{
	//提示给用户的文字信息，会根据不同场景，展示不同内容
	"msg":"付款即时到账 未到账可联系我们",
	"data":{
		//二维码信息，如果没返回，说明存在错误，参考msg的信息。
		//想展示二维码内容，可以qrcode值放到这个网址后面：https://pan.baidu.com/share/qrcode?w=280&h=280&url=
		"qrcode":"HTTPS://QR.ALIPAY.COM/FKX08406GFWYYSF0YRNC10",
		//支付渠道：1-支付宝；2-微信
		"istype":"1",
		//显示给用户的订单金额(一定要把这个价格显示在支付页上，而不是订单金额)
		"realprice":0.05
	},
	//code目前只返回1。
	"code":1,
	//判断支付成功后，要同步跳转的URL
	"url":"{{\Illuminate\Support\Facades\Config::get('global.site_url')}}/"
}
							</pre>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <!-- page-title start -->
                    <!-- ================ -->
                    <h4 class="page-title">付款成功回调通知</h4>
                    <hr>
                    <!-- page-title end -->

                    <p>用户付款成功后，我们会向您在发起付款接口传入的<mark>notify_url</mark>网址发送通知。您的服务器只要返回200状态，就表示回调已收到。如果返回状态不是200，我们会再尝试回调3次，每次间隔1分钟。</p>
                    <h5>传参方式：Post</h5>
                    <h5>参数内容：</h5>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>参数名</th>
                            <th>含义</th>
                            <th>类型</th>
                            <th>说明</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><small>paysapi_id</small></td>
                            <td><small>paysapi生成的订单ID号</small></td>
                            <td><small>string(24)</small></td>
                            <td><small>一定存在。一个24位字符串，是此订单在WapsPay服务器上的唯一编号</small></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><small>orderid</small></td>
                            <td><small>您的自定义订单号</small></td>
                            <td><small>string(50)</small></td>
                            <td><small>一定存在。是您在发起付款接口传入的您的自定义订单号</small></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><small>price</small></td>
                            <td><small>订单定价</small></td>
                            <td><small>float</small></td>
                            <td><small>一定存在。是您在发起付款接口传入的订单价格</small></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><small>realprice</small></td>
                            <td><small>实际支付金额</small></td>
                            <td><small>float</small></td>
                            <td><small>一定存在。表示用户实际支付的金额。一般会和price值一致，如果同时存在多个用户支付同一金额，就会和price存在一定差额，差额一般在1-2分钱上下，越多人同时付款，差额越大。</small></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><small>orderuid</small></td>
                            <td><small>您的自定义用户ID</small></td>
                            <td><small>string(100)</small></td>
                            <td><small>如果您在发起付款接口带入此参数，我们会原封不动传回。</small></td>
                        <tr>
                            <td>6</td>
                            <td><small>key</small></td>
                            <td><small>秘钥</small></td>
                            <td><small>string(32)</small></td>
                            <td><small>一定存在。我们把使用到的所有参数，<strong>连您的Token一起</strong>，按<mark>参数名</mark>字母升序排序。把<mark>参数值</mark>拼接在一起。做md5-32位加密，取字符串小写。得到key。您需要在您的服务端按照同样的算法，自己验证此key是否正确。只在正确时，执行您自己逻辑中支付成功代码。</small></td>
                        </tr>
                        </tbody>
                    </table>
                    <p>key的拼接顺序：如用到了所有参数，就按这个顺序拼接：orderid + orderuid + paysapi_id + price + realprice + token</p>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                    <!-- page-title start -->
                    <!-- ================ -->
                    <h4 class="page-title">付款成功自动跳转</h4>
                    <hr>
                    <!-- page-title end -->

                    <p>用户付款成功后，我们会在先通过上面的接口，通知您服务器付款成功，再过1-3秒后将用户跳转到您在发起付款接口传入的<mark>return_url</mark>网址。注：用Json方式发起支付的，不会有主动跳转。需要自行监控您的订单信息是否被我们异步回调接口修改成支付成功状态，发现您订单更新后，自行给用户显示支付成功。</p>
                    <h5>传参方式：Get</h5>
                    <h5>参数内容：</h5>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>参数名</th>
                            <th>含义</th>
                            <th>类型</th>
                            <th>说明</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td><small>orderid</small></td>
                            <td><small>您的自定义单号</small></td>
                            <td><small>string(50)</small></td>
                            <td><small>一定存在。您可以通过此orderid在您后台查询到付款确实成功后，给用户一个付款成功的展示。</small></td>
                        </tr>
                        </tbody>
                    </table>
                    <p class="text-danger"><strong>注意：请不要将此跳转认为是用户付款成功的判断条件，此行为极不安全。请根据我们的付款成功回调通知是否送到，来判断交易是否成功。</strong></p>
                    <div class="space-bottom"></div>
                    <div class="space-bottom"></div>
                </div>
                <!-- main end -->

            </div>
        </div>
    </section>

@stop