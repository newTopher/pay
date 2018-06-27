<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use phpDocumentor\Reflection\Types\Self_;

class MoneyRecord extends Model{

    const DELETED_AT = null;
    const UPDATED_AT = null;
    const CREATED_AT = null;


    protected $table = 'spay_money_record';

    static public function saveOrder(Request $request,$uid,$expire_time=''){
        if($uid && $request->has('price') && $request->has('orderid') && in_array($request->istype,[1,2])){
            $orderModel = new self();
            $orderModel->pay_type = $request->istype;
            $orderModel->real_price = floatval($request->price);
            $orderModel->uid = $uid;
            $orderModel->custom_order_id = $request->orderid;
            $orderModel->notify_url = $request->notify_url;
            $orderModel->return_url = $request->return_url;
            $orderModel->pay_status = self::PAY_STATUS_NO_PAY;

            $orderModel->custom_uid = $request->orderuid;
            $orderModel->price = '';
            $orderModel->goods_name = '';
            $orderModel->pay_account_id = '';
            $orderModel->goods_id = '';

            $orderModel->create_time = time();
            $orderModel->expire_time = time() + ($expire_time ? intval($expire_time) : Config::get('global.pay_default_expire_time'));
            $orderModel->order_id = self::genOrderId().$orderModel->uid;

            $orderModel->save();

            return $orderModel;
        }

        return false;
    }


    static public function getMoneyRecordList(Request $request,$uid){
        $moneyModel = new self();
        $query = $moneyModel->where('uid',$uid);

        if($request->has('orderid') && $request->orderid){
            $query->where('order_id',$request->orderid);
        }
        $query->orderBy('ctime','desc');

        return $query->paginate(15);
    }

    static public function getOrderById(Request $request,$uid){
        if($request->has('id')) {
            $res = (new self())->where('id', $request->id)->where('uid', $uid)->first();
            return $res;
        }
        return false;
    }



}