<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use phpDocumentor\Reflection\Types\Self_;

class Demo extends Model{

    const DELETED_AT = null;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    const STATUS_NO_PAY = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_FAIL = -1;

    protected $table = 'spay_demo';


    static public function saveDemo(Request $request,$uid){
        if($request->has('price') && in_array($request->istype,[1,2])){
            $Demo = new self();
            $Demo->pay_type = $request->istype;
            $Demo->price = floatval($request->price);
            $Demo->uid = $uid;
            $Demo->ctime = time();
            $Demo->mtime = time();
            $Demo->order_id = self::genOrderId().$Demo->uid;
            $Demo->save();

            return $Demo;
        }

        return false;
    }

    static public function updateDemo($order_id,$data=[]){
        if($Demo = (new self()) ->where('order_id',$order_id)->first()) {

            if (isset($data['status']) && $data['status']) {
                $Demo->pay_status = $data['status'];
            }
            if (isset($data['notify_time']) && $data['notify_time']) {
                $Demo->notify_time = $data['notify_time'];
            }
            $Demo->mtime = time();

            return $Demo->save();
        }
        return false;
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