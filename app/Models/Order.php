<?php

namespace App\Models;

use App\Common\Http;
use App\Jobs\OrderNotifyJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use phpDocumentor\Reflection\Types\Self_;

class Order extends Model{

    const DELETED_AT = null;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    const PAY_TYPE_ALIPAY = 1;
    const PAY_TYPE_WEPAY = 2;

    const PAY_STATUS_NO_PAY = 0;
    const PAY_STATUS_SUCCESS = 1;

    protected $table = 'spay_order';
    public static $self_money = 0;

    static public function saveOrder(Request $request,$uid,$expire_time=''){
        if($uid && $request->has('price') && $request->has('orderid') && in_array($request->istype,[1,2])){

            $baseData = UserAccount::getBestAccount(floatval($request->price),$uid,$request->istype,self::getNoExpireOrder($uid,floatval($request->price),$request->istype));
            if($baseData === false){
                return false;
            }
            $goods_name = $request->has('goods_name') ? $request->goods_name : '';
            $goods_id = '';

            $goodsInfo = Product::getProductInfoByPrice($uid,$baseData['account_id'],$request->price);
            if($goodsInfo){
                if(!$goods_name) {
                    $goods_name = $goodsInfo->product_name;
                }
                $goods_id = $goodsInfo->id;
            }
            $orderModel = new self();
            $orderModel->pay_type = $request->istype;
            $orderModel->real_price = floatval($baseData['money']);
            $orderModel->uid = $uid;
            $orderModel->custom_order_id = $request->orderid;
            $orderModel->notify_url = $request->notify_url;
            $orderModel->return_url = $request->return_url;
            $orderModel->pay_status = self::PAY_STATUS_NO_PAY;

            $orderModel->custom_uid = $request->orderuid;
            $orderModel->price = floatval($request->price);
            $orderModel->goods_name = $goods_name;
            $orderModel->pay_account_id = $baseData['account_id'];
            $orderModel->goods_id = $goods_id;

            $orderModel->create_time = time();
            $orderModel->expire_time = time() + ($expire_time ? intval($expire_time) : Config::get('global.pay_default_expire_time'));
            $orderModel->order_id = self::genOrderId().$orderModel->uid;
            $orderModel->self_money = self::$self_money;
            $orderModel->save();

            $ret =  $orderModel->toArray();
            $ret['qrstr'] = $baseData['qrstr'];

            return $ret;
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

    static public function updateOrderExpireTimeById($uid,$id,$expire_time=''){
        if($orderModel = (new self()) ->where('uid',$uid)->where('id',$id)->first()){
            $orderModel->expire_time = time() + ($expire_time ? intval($expire_time) : Config::get('global.pay_default_expire_time'));;
            $orderModel->update_time = time();
            $orderModel->save();

            return $orderModel;
        }
        return false;
    }

    static public function getRequestOrderById($uid,$id){
        return (new self()) ->where('uid',$uid)->where('id',$id)->first();
    }

    static public function updateOrderByApp($uid,$pay_type,$price,$pay_time,$pay_extra){
        /*$res = (new self())->where('uid',$uid)
                            ->where('pay_type',$pay_type)
                            ->where('price',$price)
                            ->where('pay_status',self::PAY_STATUS_NO_PAY)
                            ->where('expire_time','>=',time())
                            ->first();
        */
        $res = (new self())->where('uid',$uid)
            ->first();
        if($res){
            $res->app_ret = $pay_extra;
            $res->app_pay_time = $pay_time;
            $res->pay_status = self::PAY_STATUS_SUCCESS;
            $res->recive_pay_time = time();
            $res->recive_times = 1;
            $res->update_time = time();

            if($res->save()){
                #把需要通知的订单放入队列
                $apiUserConfig = UserApiConfig::getUserApiConfigByUid($uid);
                app('Illuminate\Contracts\Bus\Dispatcher')->dispatch(new OrderNotifyJob($res,$apiUserConfig->api_token));
                return true;
            }else{
                return false;
            }
        }else{
            return NoOrder::saveOrder($uid,$pay_type,$price,$pay_time,$pay_extra);
        }
    }

    static public function getCounterInfo($uid){
        $todayMoney = (new self())->where('uid',$uid)
            ->where('pay_status',1)
            ->where('recive_pay_time','>',strtotime(date("Y-m-d")." 00:00:00"))
            ->where('recive_pay_time','<=',strtotime(date("Y-m-d")." 23:59:59"))
            ->sum('price');

        $yesterdayMoney = (new self())->where('uid',$uid)
            ->where('pay_status',1)
            ->where('recive_pay_time','>',strtotime(date("Y-m-d",strtotime("-1 days"))." 00:00:00"))
            ->where('recive_pay_time','<=',strtotime(date("Y-m-d",strtotime("-1 days"))." 23:59:59"))
            ->sum('price');

        $sevenMoney = (new self())->where('uid',$uid)
            ->where('pay_status',1)
            ->where('recive_pay_time','>',strtotime(date("Y-m-d",strtotime("-7 days"))." 00:00:00"))
            ->where('recive_pay_time','<=',strtotime(date("Y-m-d",strtotime("-7 days"))." 23:59:59"))
            ->sum('price');

        $monthMoney = (new self())->where('uid',$uid)
            ->where('pay_status',1)
            ->where('recive_pay_time','>',strtotime(date("Y-m-d",strtotime("-1 months"))." 00:00:00"))
            ->where('recive_pay_time','<=',strtotime(date("Y-m-d",strtotime("-1 months"))." 23:59:59"))
            ->sum('price');

        $todayOrders = (new self())->where('uid',$uid)
            ->where('pay_status',1)
            ->where('recive_pay_time','>',strtotime(date("Y-m-d")." 00:00:00"))
            ->where('recive_pay_time','<=',strtotime(date("Y-m-d")." 23:59:59"))
            ->count();

        $yesterdayOrders = (new self())->where('uid',$uid)
            ->where('pay_status',1)
            ->where('recive_pay_time','>',date("Y-m-d",strtotime("-1 days"))." 00:00:00")
            ->where('recive_pay_time','<=',date("Y-m-d",strtotime("-1 days"))." 23:59:59")
            ->count();

        $sevenOrders = (new self())->where('uid',$uid)
            ->where('pay_status',1)
            ->where('recive_pay_time','>',strtotime(date("Y-m-d",strtotime("-7 days"))." 00:00:00"))
            ->where('recive_pay_time','<=',strtotime(date("Y-m-d",strtotime("-7 days"))." 23:59:59"))
            ->count();

        $monthOrders = (new self())->where('uid',$uid)
            ->where('pay_status',1)
            ->where('recive_pay_time','>',strtotime(date("Y-m-d",strtotime("-1 months"))." 00:00:00"))
            ->where('recive_pay_time','<=',strtotime(date("Y-m-d",strtotime("-1 months"))." 23:59:59"))
            ->count();

        $balance = Account::where('uid',$uid)->first();
        return [
            'todayMoney'=>$todayMoney,
            'yesterdayMoney'=>$yesterdayMoney,
            'sevenMoney'=>$sevenMoney,
            'monthMoney'=>$monthMoney,
            'todayOrders'=>$todayOrders,
            'yesterdayOrders'=>$yesterdayOrders,
            'sevenOrders'=>$sevenOrders,
            'monthOrders'=>$monthOrders,
            'balance'=>$balance->money
        ];

    }

    static public function getOrderList(Request $request,$uid){
        $orderModel = new self();
        $query = $orderModel->where('uid',$uid);
        if($request->has('istype') && $request->istype){
            $query->where('pay_type',$request->istype);
        }
        if($request->has('orderid') && $request->orderid){
            $query->where('order_id',$request->orderid);
        }
        if($request->has('orderuid') && $request->orderuid){
            $query->where('custom_uid',$request->orderuid);
        }
        if($request->has('realprice') && $request->realprice){
            $query->where('real_price',$request->realprice);
        }
        if($request->has('account_id') &&  $request->account_id){
            $query->where('account_id',$request->account_id);
        }
        $query->orderBy('create_time','desc');

        return $query->paginate(15);
    }

    static public function getOrderById(Request $request,$uid){
        if($request->has('id')) {
            $res = (new self())->where('id', $request->id)->where('uid', $uid)->first();
            return $res;
        }
        return false;
    }

    static public function getNoExpireOrder($uid,$price,$pay_type){
        $priceList = [];
        $orderList = (new self())->where('pay_type',$pay_type)
            ->where('uid',$uid)
            ->where('pay_status',0)
            ->where('expire_time','>',time())
            ->where('real_price','>=',$price-0.01*Config::get('global.pay_money_range'))
            ->where('real_price','<=',$price+0.01*Config::get('global.pay_money_range'))
            ->where('real_price','!=',0)
            ->get(['real_price'])
            ->toArray();
        if($orderList){
            foreach ($orderList as $key=>$val){
                if(!in_array($val['real_price'],$priceList)){
                    $priceList[] = $val['real_price'];
                }
            }
        }
        return $priceList;
    }

    static public function getSelfMoney($uid,$pay_type){
        if($data = Qrcode::getSelfMoneyQrcode($uid,$pay_type)){
            $qrcode = $data;
            self::$self_money = 1;
            return $qrcode;
        }else{
            return false;
        }

    }



}