<nav>
    <ul class="nav nav-pills nav-stacked">
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/appdownload'))class="active"@endif><a href="/appdownload">应用下载页</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/app_miui'))class="active"@endif><a href="/app_miui">小米手机</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/app_oppo'))class="active"@endif><a href="/app_oppo">OPPO手机</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/app_huawei'))class="active"@endif><a href="/app_huawei">华为手机</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/app_vivo'))class="active"@endif><a href="/app_vivo">Vivo手机</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/app_samsung'))class="active"@endif><a href="/app_samsung">三星手机</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/app_meizu'))class="active"@endif><a href="/app_meizu">魅族手机</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/app_zte'))class="active"@endif><a href="/app_zte">中兴手机</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/app_lg'))class="active"@endif><a href="/app_lg">LG手机</a></li>
    </ul>
</nav>