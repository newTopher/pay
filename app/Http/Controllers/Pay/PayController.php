<?php

namespace App\Http\Controllers\Pay;
use App\Models\Order;
use App\Models\UserApiConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Laravel\Lumen\Routing\Controller as BaseController;

class PayController extends BaseController
{


    public function index(Request $request){
        $api_key = $request->uid;
        if($api_key){
            $sessionId = $request->getSession()->getId();
            $key = $request->key;
            $cacheKey = Config::get('global.cache_prefix')['pay_request']."_".$api_key."_".md5($sessionId.$key);
            $apiConfig = UserApiConfig::where('api_key',$api_key)->first();

            if($apiConfig){
                $expire_time = $apiConfig->qrcode_expire_time;
                if(Cache::has($cacheKey) && ($cacheData = Cache::get($cacheKey))){
                    $cacheData = json_decode($cacheData,true);

                    if(!($orderData = Order::getRequestOrderById($apiConfig->uid,$cacheData['data']['id']))){
                        return response()->json([
                            'code'=> -995,
                            'msg'=>'request api param error'
                        ]);
                    }
                    if($orderData->pay_status == 1 && $orderData->custom_order_id == $request->orderid){
                        #已经支付
                        return view('pay.pay', $cacheData);
                    }
                    if(($orderData = Order::updateOrderExpireTimeById($apiConfig->uid,$orderData->id,$expire_time)) === false){
                        return response()->json([
                            'code'=> -990,
                            'msg'=>'request api param error'
                        ]);
                    }else {
                        $newCacheData = $cacheData;
                        $newCacheData['show_expire_time'] = $orderData->expire_time;
                        return view('pay.pay', $newCacheData);
                    }
                }

                if(($orderData = Order::saveOrder($request,$apiConfig->uid,$expire_time)) !== false) {

                    $retData = [
                        'data' => $orderData,
                        'api_config'=>$apiConfig->toArray(),
                        'expire_time' => $expire_time ? intval($expire_time) : Config::get('global.pay_default_expire_time'),
                        'show_expire_time'=> $orderData['expire_time']
                    ];
                    Cache::put($cacheKey,json_encode($retData),round(($orderData['expire_time'] - time())/60,0));
                    return view('pay.pay', $retData);
                }else{
                    return response()->json([
                        'code'=> -993,
                        'msg'=>'request api param error'
                    ]);
                }
            }

        }

    }

    public function result(Request $request){
        if($request->has('wapsapi_id') && $request->wapsapi_id){
            $orderData = Order::where('order_id',$request->wapsapi_id)->first();
            if($orderData && $orderData->pay_status == 1){
                return response()->json([
                    'code'=> 1,
                    'msg'=>'success',
                    'url'=>$orderData['return_url']."?orderid=".$orderData->order_id
                ]);
            }else{
                return response()->json([
                    'code'=> -1,
                    'msg'=>'no this order'
                ]);
            }

        }

    }
}