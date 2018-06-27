<?php

namespace App\Http\Controllers\Front;
use App\Common\Log;
use App\Common\Util;
use App\Models\Account;
use App\Models\Demo;
use App\Models\MoneyRecord;
use App\Models\Order;
use App\Models\User;
use App\Models\UserApiConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;
use Illuminate\Support\Facades\Config;

class DemoController extends BaseController
{
    const DEMO_UID = 9;

    public function pay(Request $request){
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request);
            if($valid !== true){
                return $valid;
            }

            if(($demo = Demo::saveDemo($request,self::DEMO_UID)) !== false){
                $apiConfig = UserApiConfig::getUserApiConfigByUid(self::DEMO_UID);
                $ret = [
                    'istype'=>$demo->pay_type,
                    'orderid'=>$demo->order_id,
                    'orderuid'=>$demo->uid,
                    'price'=>$demo->price,
                    'notify_url'=>Config::get('global.notify_url_demo'),
                    'return_url'=>Config::get('global.return_url_demo'),
                    'uid'=>$apiConfig->api_key
                ];
                $key = Util::getSign($ret,$apiConfig->api_token);
                $ret['key'] = $key;

                return $this->success(1,"订单创建成功",$ret);
            }else{
                return $this->error(-1,"操作失败请重试");
            }

        }else{
            $this->error(-1,'非法操作');
        }
    }

    public function notify(Request $request){
        Log::info("收到demo notify".json_encode($request->all()));
    }


    public function ret(Request $request){
        if($request->has('orderid')) {
            Log::info("收到demo ret orderid:".$request->orderid);
            echo $request->orderid;
        }
    }

}
