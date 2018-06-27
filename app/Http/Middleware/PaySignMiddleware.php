<?php

namespace App\Http\Middleware;

use App\Common\Util;
use App\Models\User;
use App\Models\UserApiConfig;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PaySignMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->has('uid') ||
            !$request->has('price') ||
            !$request->has('istype') ||
            !$request->has('notify_url') ||
            !$request->has('return_url') ||
            !$request->has('orderid') ||
            !$request->has('key')
        ){
            return response()->json([
                'code'=> -999,
                'msg'=>'request error'
            ]);
        }else{
            $apiConfig = UserApiConfig::where('api_key',$request->uid)->first();
            if(!$apiConfig){
                return response()->json([
                    'code'=> -999,
                    'msg'=>'request no api error'
                ]);
            }
            $userdData = User::where('id',$apiConfig->uid)->first();
            if(!$userdData || $userdData->is_active == 0){
                return response()->json([
                    'code'=> -997,
                    'msg'=>'request api no active'
                ]);
            }
            $params = [];
            $key = $request->key;
            $params['uid'] = $request->uid;
            $params['price'] = $request->price;
            $params['istype'] = $request->istype;
            $params['notify_url'] = $request->notify_url;
            $params['return_url'] = $request->return_url;
            $params['orderid'] = $request->orderid;

            if($request->has('goodsname')){
                $params['goodsname'] = $request->goodsname;
            }
            if($request->has('orderuid')){
                $params['orderuid'] = $request->orderuid;
            }
            $token = $apiConfig->api_token;
            if($key !== Util::getSign($params,$token)) {
                return response()->json([
                    'code'=> -997,
                    'msg'=>'request api no sign'
                ]);
            }

        }
        $response = $next($request);
        return $response;
    }

}
