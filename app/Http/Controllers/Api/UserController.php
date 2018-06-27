<?php

namespace App\Http\Controllers\Api;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Crypt;

class UserController extends BaseController
{

    public function login(Request $request){
        if($request->isMethod('GET')){
            if((isset($request->param['email']) && $request->param['email']) &&
                (isset($request->param['password']) && $request->param['password'])){
                if($res = User::where('email',$request->param['email'])->first()){
                    if($res->password == md5($request->param['password'].$res->salt)){
                        $login_token = Crypt::encrypt(time().$res->id);
                        User::updateUser($res->id,['login_time'=>time(),'login_token'=>$login_token]);
                        return $this->success(1, "登录成功",['token'=>$login_token,'url'=>[
                            'recharge_url'=>url('user/myCounter'),
                            'order_url'=>url('order/myOrder')
                        ]]);
                    }else {
                        return $this->error(-3, "账号或者密码错误登录失败");
                    }
                }else{
                    return $this->error(-2,"账号或者密码错误登录失败");
                }
            }else{
                return $this->error(-4,'req error');
            }
        }else{
            return $this->error(-1,'req error');
        }
    }

    public function getcounter(Request $request){
        if($request->isMethod('get')){
            if(isset($request->user['uid']) && $request->user['uid']) {
                $uid = $request->user['uid'];
                return $this->success(1,'success',Order::getCounterInfo($uid));
            }else{
                return $this->error(-4,'req error');
            }
        }else{
            return $this->error(-1,'req error');
        }
    }

}
