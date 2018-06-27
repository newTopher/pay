<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use phpDocumentor\Reflection\Types\Self_;

class UserRecharge extends Model{

    const DELETED_AT = null;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    const RECHARGE_STATUS_NO_PAY = 0;
    const RECHARGE_STATUS_SUCCESS = 1;
    const RECHARGE_STATUS_FAIL = -1;

    protected $table = 'spay_recharge';


    static public function saveRecharge(Request $request,$uid){
        if($request->has('price') && in_array($request->istype,[1,2])){
            $userRecharge = new self();
            $userRecharge->pay_type = $request->istype;
            $userRecharge->price = floatval($request->price);
            $userRecharge->uid = $uid;
            $userRecharge->ctime = time();
            $userRecharge->mtime = time();
            $userRecharge->order_id = self::genOrderId().$userRecharge->uid;
            $userRecharge->save();

            return $userRecharge;
        }

        return false;
    }

    static public function updateRecharge($order_id,$data=[]){
        if($userRecharge = (new self()) ->where('order_id',$order_id)->first()) {

            if (isset($data['status']) && $data['status']) {
                $userRecharge->pay_status = $data['status'];
            }
            if (isset($data['notify_time']) && $data['notify_time']) {
                $userRecharge->notify_time = $data['notify_time'];
            }
            $userRecharge->mtime = time();

            return $userRecharge->save();
        }
        return false;
    }

    static public function getUserAccountByOrderId($order_id){
        $userRecharge = (new self()) ->where('order_id',$order_id)->first();
        if(!$userRecharge){
            return false;
        }else{
            return $userRecharge;
        }
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



}