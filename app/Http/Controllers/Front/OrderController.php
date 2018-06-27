<?php

namespace App\Http\Controllers\Front;
use App\Common\Http;
use App\Common\Util;
use App\Jobs\OrderNotifyJob;
use App\Models\NoOrder;
use App\Models\Order;
use App\Models\UserAccount;
use App\Models\UserApiConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;
use Illuminate\Support\Facades\Config;

class OrderController extends BaseController
{

    public function index(Request $request){
        $accountList = UserAccount::getUserAccountListByUid($this->getUser()['id'])->toArray();
        $orderList = Order::getOrderList($request,$this->getUser()['id']);
        $accountIdMapList = $this->arrChangeKey($accountList);
        return view('front.order.index',[
            'account_list'=>$accountList,
            'order_list'=>$orderList,
            'account_id_map_list'=>$accountIdMapList,
            'request'=>$request
        ]);
    }

    public function norder(Request $request){
        $accountList = UserAccount::getUserAccountListByUid($this->getUser()['id'])->toArray();
        $orderList = NoOrder::getOrderList($request,$this->getUser()['id']);
        $accountIdMapList = $this->arrChangeKey($accountList);
        return view('front.order.norder',[
            'account_list'=>$accountList,
            'order_list'=>$orderList,
            'account_id_map_list'=>$accountIdMapList,
            'request'=>$request
        ]);
    }

    public function resend(Request $request,Http $http){
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request);
            if($valid !== true){
                return $valid;
            }
            if(($res = Order::getOrderById($request,$this->getUser()['id']))){
                if($res->notify_url){
                    $apiUserConfig = UserApiConfig::getUserApiConfigByUid($this->getUser()['id']);
                    app('Illuminate\Contracts\Bus\Dispatcher')->dispatch(new OrderNotifyJob($res,$apiUserConfig->api_token));
                    $ret = Util::notify($res,$apiUserConfig->api_token);
                    if($ret !== false){
                        $res->recive_times = $res->recive_times +1;
                        $res->update_time = time();
                        if($res->save()){
                            return $this->success(1,"操作成功");
                        }else{
                            return $this->error(-4,"系统繁忙请稍后再试",[]);
                        }
                    }else{
                        return $this->error(-3,"接收服务器返回异常，通知失败",[]);
                    }
                }else{
                    return $this->error(-2,"此订单未设置通知地址",[]);
                }
            }else{
                return $this->error(-5,"非法操作",[]);
            }
        }
    }

    public function hasget(Request $request){
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request);
            if($valid !== true){
                return $valid;
            }
            if(($res = Order::getOrderById($request,$this->getUser()['id']))){
                if($res->pay_status != 1){
                    if($res->notify_url){
                        $apiUserConfig = UserApiConfig::getUserApiConfigByUid($this->getUser()['id']);
                        $ret = Util::notify($res,$apiUserConfig->api_token);
                        if($ret !== false){
                            $res->pay_status = 1;
                            $res->opt_method = 2;
                            $res->recive_times = $res->recive_times +1;
                            $res->recive_pay_time = time();
                            $res->update_time = time();
                            if($res->save()){
                                return $this->success(1,"操作成功");
                            }else{
                                return $this->error(-4,"系统繁忙请稍后再试",[]);
                            }
                        }else{
                            return $this->error(-3,"接收服务器返回异常，通知失败",[]);
                        }
                    }else{
                        return $this->error(-2,"此订单未设置通知地址",[]);
                    }

                }else{
                    return $this->error(-1,"此订单已经收款成功了",[]);
                }
            }else{
                return $this->error(-5,"非法操作",[]);
            }
        }
    }

}