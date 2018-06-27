<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['middleware' => 'WebAuthUser'],function () use ($router){
    $router->post('user/logout', 'UserController@logout');

    $router->get('user/mySetting', 'UserController@setting');
    $router->post('user/mySetting', 'UserController@setting');

    $router->get('user/htmPackage', 'UserController@package');
    $router->post('user/htmPackage', 'UserController@package');

    $router->get('user/mySettingPassword', 'UserController@setpassword');
    $router->post('user/mySettingPassword', 'UserController@setpassword');

    $router->get('user/mySettingPassword', 'UserController@setpassword');
    $router->post('user/mySettingPassword', 'UserController@setpassword');

    $router->get('user/mySettingApiSet', 'UserController@apiset');
    $router->post('user/mySettingApiSet', 'UserController@apiset');

    $router->get('user/mySettingApiSetInfo', 'UserController@apisetinfo');
    $router->post('user/mySettingApiSetInfo', 'UserController@apisetinfo');

    $router->get('user/myAccount', 'AccountController@account');
    $router->get('user/myItem', 'AccountController@goods');

    $router->post('user/saveAccount', 'AccountController@account_save');
    $router->post('user/optAccount', 'AccountController@account_opt');

    $router->get('user/myCounter', 'UserController@counter');
    $router->get('user/myMoneyHistory', 'UserController@money_history');
    $router->post('user/recharge', 'UserController@recharge');

    $router->get('user/allUsers', 'UserController@allusers');
    $router->get('user/myUsers', 'UserController@myusers');

    $router->post('user/addqrcode', 'AccountController@addqrcode');
    $router->post('user/addgoods', 'AccountController@addgoods');

    $router->post('user/clearQrcode', 'AccountController@clear_qrcode');
    $router->post('user/clearAccount', 'AccountController@clear_account');

    $router->get('order/myOrder', 'OrderController@index');
    $router->get('order/myNoOrder', 'OrderController@norder');

    $router->post('order/resendNotify', 'OrderController@resend');
    $router->post('order/hasGetMoney', 'OrderController@hasget');

});
$router->get('index/index', 'IndexController@index');
$router->get('user/register', 'UserController@register');
$router->post('user/register', 'UserController@register');
$router->post('user/login', 'UserController@login');

$router->get('/', 'IndexController@index');
$router->get('/appdownload', 'IndexController@appdownload');
#app setting
$router->get('/appdownload', 'IndexController@appdownload');
$router->get('/app_miui', 'IndexController@app_miui');
$router->get('/app_oppo', 'IndexController@app_oppo');
$router->get('/app_huawei', 'IndexController@app_huawei');
$router->get('/app_vivo', 'IndexController@app_vivo');
$router->get('/app_samsung', 'IndexController@app_samsung');
$router->get('/app_meizu', 'IndexController@app_meizu');
$router->get('/app_zte', 'IndexController@app_zte');
$router->get('/app_lg', 'IndexController@app_lg');

#apidoc
$router->get('/docindex', 'IndexController@docindex');
$router->get('/docpay', 'IndexController@docpay');
$router->get('/docgetinfo', 'IndexController@docgetinfo');
$router->get('/docdemo', 'IndexController@docdemo');

#faq
$router->get('/faqindex', 'IndexController@faqindex');
$router->get('/faqused', 'IndexController@faqused');
$router->get('/about', 'IndexController@about');

#demo
$router->post('/demopay', 'DemoController@pay');
$router->post('/demo/notify', 'DemoController@notify');
$router->get('/demo/ret', 'DemoController@ret');

