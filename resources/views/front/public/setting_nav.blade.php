<nav>
    <ul class="nav nav-pills nav-stacked">
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/user/mySetting'))class="active"@endif><a href="{{ url('/user/mySetting') }}">基本信息</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/user/htmPackage'))class="active"@endif><a href="{{ url('/user/htmPackage') }}">我的套餐</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/user/mySettingPassword'))class="active"@endif><a href="{{ url('/user/mySettingPassword') }}">修改密码</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/user/mySettingApiSet'))class="active"@endif><a href="{{ url('/user/mySettingApiSet') }}">支付参数设置</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/user/mySettingApiSetInfo'))class="active"@endif><a href="{{ url('/user/mySettingApiSetInfo') }}">API接口信息</a></li>
    </ul>
</nav>