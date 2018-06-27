<?php

namespace App\Http\Controllers\Api;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;

class TransController extends BaseController
{

    public function recive(Request $request){
        if($request->isMethod('GET')){
            if(isset($request->user['uid']) && $request->user['uid']){
                $uid = $request->user['uid'];
                $pay_type = isset($request->param['pay_type']) ? $request->param['pay_type'] : '';
                $price = isset($request->param['price']) ? $request->param['price'] : '';
                $pay_time = isset($request->param['pay_time']) ? $request->param['pay_time'] : '';
                $pay_extra = isset($request->param['pay_extra']) ? $request->param['pay_extra'] : '';
                if($pay_type && $price && $pay_time){
                    $ret = Order::updateOrderByApp($uid,$pay_type,$price,$pay_time,$pay_extra);
                    if($ret !== false){
                        return $this->success(1,'success');
                    }else{
                        return $this->error(-2,'fail');
                    }
                }else{
                    return $this->error(-5,'param error');
                }
            }else{
                return $this->error(-4,'req error');
            }
        }else{
            return $this->error(-1,'req error');
        }
    }

}
