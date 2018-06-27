<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use phpDocumentor\Reflection\Types\Self_;

class NoOrder extends Model{

    const DELETED_AT = null;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    const PAY_STATUS_NO_PAY = 0;
    const PAY_STATUS_SUCCESS = 1;

    protected $table = 'spay_no_order';

    static public function saveOrder($uid,$pay_type,$price,$pay_time,$pay_extra){
        $time = time();
        $orderModel = new self();
        $orderModel->pay_type = $pay_type;
        $orderModel->uid = $uid;
        $orderModel->pay_status = self::PAY_STATUS_SUCCESS;
        $orderModel->app_pay_time = $pay_time;
        $orderModel->app_ret = $pay_extra;
        $orderModel->price = $price;
        $orderModel->ctime = $time;
        $orderModel->pay_time = $time;
        $orderModel->mtime = $time;
        $orderModel->order_id = self::genOrderId().$orderModel->uid;
        $orderModel->save();

        return $orderModel;
    }

    static public function genOrderId(){
        @date_default_timezone_set("PRC");
        $order_id_main = date('YmdHis') . rand(10000000,99999999);
        $order_id_len = strlen($order_id_main);
        $order_id_sum = 0;
        for($i=0; $i<$order_id_len; $i++){
            $order_id_sum += (int)(substr($order_id_main,$i,1));
        }

        $order_id = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
        return $order_id;
    }

    static public function getOrderList(Request $request,$uid){
        $orderModel = new self();
        $query = $orderModel->where('uid',$uid);
        if($request->has('istype') && $request->istype){
            $query->where('pay_type',$request->istype);
        }
        if($request->has('money') && $request->money){
            $query->where('price',$request->money);
        }
        if($request->has('account_id') &&  $request->account_id){
            $query->where('account_id',$request->account_id);
        }
        $query->orderBy('ctime','desc');

        return $query->paginate(15);
    }



}