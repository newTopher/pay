<nav>
    <ul class="nav nav-pills nav-stacked">
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/docindex'))class="active"@endif><a href="/docindex">准备工作</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/docpay'))class="active"@endif><a href="/docpay">发起付款接口</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/docgetinfo'))class="active"@endif><a href="/docgetinfo">查询接口</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/docdemo'))class="active"@endif><a href="/docdemo">Demo下载</a></li>
    </ul>
</nav>