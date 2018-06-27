<?php
/**
 * Created by PhpStorm.
 * User: InkeYFJS001
 * Date: 2018/5/22
 * Time: 15:25
 */
namespace App\Common;

use Illuminate\Support\Facades\Config;

class Util {

    static function notify($orderData,$api_token){

        $params = self::getOrderSign($orderData,$api_token);
        $httpClient = new Http();
        $httpClient->setParams($params);
        $httpClient->setTimeout(3);
        Log::info("job_process____:url：".$orderData->notify_url.'|params:'.json_encode($params));
        return $httpClient->post($orderData->notify_url,'json');
    }

    static function getRandPayDomain(){
        return Config::get('global.pay_domain')[0][0];
    }

    static function getOrderSign($orderData,$api_token){
        $params = [
            'wappays_id'=>$orderData->order_id,
            'orderid'=>$orderData->custom_order_id,
            'price'=>$orderData->price,
            'real_price'=>$orderData->real_price,
            'orderuid'=>$orderData->custom_uid,
            'token'=>$api_token
        ];
        ksort($params);
        $key = md5(implode(',',$params));
        unset($params['token']);
        $params['key'] = $key;
        return $params;
    }

    static function getSign($data,$token){
        $params = $data;
        $params['token'] = $token;
        ksort($params);
        $key = md5(implode(',',$params));
        return $key;
    }


}