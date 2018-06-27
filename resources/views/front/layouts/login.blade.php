@if ($loginuser = app('session')->get(\Illuminate\Support\Facades\Config::get('session.user_session_key')))
    <div class="btn-group dropdown">
        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" id="btnlogin"><i class="fa fa-user"></i> 欢迎,{{$loginuser['name']}}</button>
        <ul class="dropdown-menu dropdown-menu-right dropdown-animation">
            <li><a href="{{ url('/user/myCounter') }}">我的收入统计</a></li>
            {{--@if ($loginuser['role_type'] == 0)--}}
            {{--<li><a href="allUsers">所有会员</a></li>--}}
            {{--@endif--}}
            {{--@if ($loginuser['role_type'] == 2)--}}
            {{--<li><a href="{{ url('/user/myUsers') }}">我的下级会员</a></li>--}}
            {{--@endif--}}

            <li><a href="{{ url('/user/allUsers') }}">所有会员</a></li>
            <li><a href="{{ url('/user/myUsers') }}">我的下级会员</a></li>
            <li><a href="{{ url('/user/myAccount') }}">支付账户管理</a></li>
            <li><a href="{{ url('/order/myOrder') }}">订单管理</a></li>
            <li><a href="{{ url('/order/myNoOrder') }}">无匹配订单收款</a></li>
            <li><a href="{{ url('/user/myMoneyHistory') }}">资金变动明细</a></li>
            <li><a href="{{ url('/user/myItem') }}">商品管理</a></li>
            <li><a href="{{ url('/user/mySetting') }}">账号设置</a></li>
            <li><a href="#" id="logout">安全退出</a></li>
        </ul>
    </div>
    @else
    <div class="btn-group dropdown">
        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" id="btnlogin"><i class="fa fa-user"></i> 登录</button>
        <ul class="dropdown-menu dropdown-menu-right dropdown-animation">
            <li>
                <form class="form" role="form" id="loginform">
                    <div class="form-group has-feedback">
                        <label class="control-label">用户名</label>
                        <input id="loginEmail" type="email" name="loginEmail" class="form-control" placeholder="电子邮箱" required>
                        <i class="fa fa-user form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="control-label">密码</label>
                        <input type="password" id="loginPassword" name="loginPassword" class="form-control" minlength="8" placeholder="密码至少8位" required>
                        <i class="fa fa-lock form-control-feedback"></i>
                    </div>
                    <button id="loginBtn" type="button" class="btn btn-group btn-dark btn-sm">登录</button>
                    <span>或</span>
                    <a href="{{url('user/register')}}"  class="btn btn-default btn-sm">注册</a>
                    <ul>
                        <li><a href="forgetPassword.htm" >忘记密码</a></li>
                    </ul>

                </form>
            </li>
        </ul>
    </div>
@endif

