<nav>
    <ul class="nav nav-pills nav-stacked">
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/faqindex'))class="active"@endif><a href="/faqindex">接入问题</a></li>
        <li @if(app('session')->get(\Illuminate\Support\Facades\Config::get('session.cur_url_key')) == url('/faqused'))class="active"@endif><a href="/faqused">使用过程中问题</a></li>
    </ul>
</nav>