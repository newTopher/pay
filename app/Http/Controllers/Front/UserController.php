<?php

namespace App\Http\Controllers\Front;
use App\Models\Account;
use App\Models\MoneyRecord;
use App\Models\Order;
use App\Models\User;
use App\Models\UserApiConfig;
use App\Models\UserRecharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;
use Illuminate\Support\Facades\Config;
use Qiniu\Auth;

class UserController extends BaseController
{

    public function register(Request $request){
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request);
            if($valid !== true){
                return $valid;
            }
            if($request->post('password') != $request->post('password2')){
                return $this->error(-3,"两次密码输入不一致");
            }
            if($res = User::where('email',$request->post('inputEmail',''))->first()){
                return $this->error(-2,"用户已存在请更换邮箱注册");
            }
            if(User::store($request) === true){
                return $this->success(1,"注册成功请登录",[],url('/index/index'));
            }

        }
        $this->setCurUrl($request);
        return view('front.user.register');
    }

    public function login(Request $request){
        if($request->isMethod('POST') && $request->has('loginEmail') && $request->has('loginPassword')){
            $valid = $this->validRequset($request);
            if($valid !== true){
                return $valid;
            }
            if($res = User::where('email',$request->post('loginEmail',''))->first()){
                if($res->password == md5($request->post('loginPassword').$res->salt)){
                    $this->setUser($res);
                    User::updateUser($res->id,['login_time'=>time()]);

                    return $this->success(1, "登录成功",[],url('/user/myCounter'));
                }else {
                    return $this->error(-3, "账号或者密码错误登录失败");
                }
            }else{
                return $this->error(-2,"账号或者密码错误登录失败");
            }
        }
    }

    public function logout(Request $request){
        if($request->isMethod('POST')){
            $this->destorySession();
            return $this->success(1, "安全退出成功",[],url('/index/index'));
        }
    }

    public function setting(Request $request){
        $this->setCurUrl($request);
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request,['qq']);
            if($valid !== true){
                return $valid;
            }

            if(User::saveUser($request) !== false){
                return $this->success(1,"修改成功",[],url('/user/home'));
            }else{
                return $this->error(-1,"修改失败请重试",[]);
            }

        }
        return view('front.user.setting',['user'=>User::getUserById($this->getUser()['id'])]);
    }

    public function setpassword(Request $request){
        $this->setCurUrl($request);
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request);
            if($valid !== true){
                return $valid;
            }

            if($request->newpassword != $request->newpassword1){
                return $this->error(-4,"两次密码输入不一致",[]);
            }

            if($res = User::where('id',$this->getUser()['id'])->first()){
                if($res->password != md5($request->post('oldpassword').$res->salt)){
                    return $this->error(-5,"旧密码不正确",[]);
                }
                if($res->password != md5($request->post('newpassword').$res->salt)){
                    User::updateUser($res->id,['password'=>md5($request->post('newpassword').$res->salt)]);

                    return $this->success(1, "密码修改成功",[],url('/user/setpassword'));
                }else {
                    return $this->error(-3, "新密码不能与旧密码一样");
                }
            }else{
                return $this->error(-2,"账号不存在");
            }

        }
        return view('front.user.setpassword');
    }

    public function apiset(Request $request){
        $accessKey = Config::get('global.qiniu_key');
        $secretKey = Config::get('global.qiniu_secret');
        $bucket = Config::get('global.qiniu_bucket');
        // 初始化Auth状态
        $auth = new Auth($accessKey, $secretKey);
        // 简单上传凭证
        $expires = 3600;
        $policy = null;
        $upToken = $auth->uploadToken($bucket, null, $expires, $policy, true);

        $this->setCurUrl($request);
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request,['select_type','view_logo','view_company','isfinish_release']);
            if($valid !== true){
                return $valid;
            }
            $data = [];
            $data['qrcode_expire_time'] = $request->has('expire_time') ? $request->expire_time : '';
            if($data['qrcode_expire_time']){
                if($data['qrcode_expire_time'] < 120 && $data['qrcode_expire_time'] > 600){
                    return $this->error(-2,"过期时间请设置再120-600秒之间",[]);
                }
            }
            $data['is_paydone_enable'] = $request->has('isfinish_release') ? $request->isfinish_release : '';
            $data['view_logo'] = $request->has('view_logo') ? $request->view_logo : '';
            $data['view_company'] = $request->has('view_company') ? $request->view_company : '';
            $data['select_type'] = $request->has('select_type') ? $request->select_type : '';

            if(UserApiConfig::saveUserApiConfig($this->getUser()['id'],$data) !== false){
                return $this->success(1,"修改成功",[],url('/user/mySettingApiSet'));
            }else{
                return $this->error(-1,"修改失败请重试",[]);
            }

        }
        $userApiConfigData = UserApiConfig::getApiConfigDataByUid($this->getUser()['id']);
        return view('front.user.apiset',['userApiConfigData'=>$userApiConfigData,'upToken'=>$upToken]);
    }

    public function apisetinfo(Request $request){
        $this->setCurUrl($request);
        if($request->isMethod('POST')){
            if(UserApiConfig::resetApiInfo($this->getUser()['id']) !== false){
                return $this->success(1,"重置成功",[],url('user/mySettingApiSetInfo'));
            }else{
                return $this->error(-1,"修改失败请重试",[]);
            }

        }
        $userApiConfigData = UserApiConfig::saveUserApiConfig($this->getUser()['id']);
        return view('front.user.apisetinfo',['userApiConfigData'=>$userApiConfigData]);
    }

    public function package(Request $request){
        $this->setCurUrl($request);
        return view('front.user.package',['mealdata'=>Account::getUserAccountByUid($this->getUser()['id'])]);
    }

    public function counter(Request $request){
        $this->setCurUrl($request);
        $counterInfo = Order::getCounterInfo($this->getUser()['id']);
        $userInfo = Account::getUserAccountByUid($this->getUser()['id']);
        return view('front.user.counter',['counterInfo'=>$counterInfo,'userInfo'=>$userInfo]);
    }

    public function recharge(Request $request){
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request);
            if($valid !== true){
                return $valid;
            }

            if(($recharge = UserRecharge::saveRecharge($request,$this->getUser()['id'])) !== false){
                $apiConfig = UserApiConfig::getUserApiConfigByUid($this->getUser()['id']);
                $ret = [
                    'istype'=>$recharge->pay_type,
                    'key'=>$apiConfig->api_token,
                    'orderid'=>$recharge->order_id,
                    'orderuid'=>$recharge->uid,
                    'price'=>$recharge->price,
                    'notify_url'=>Config::get('global.notify_url'),
                    'return_url'=>Config::get('global.return_url'),
                    'uid'=>$apiConfig->api_key
                ];
                return $this->success(1,"订单创建成功",$ret);
            }else{
                return $this->error(-1,"操作失败请重试");
            }

        }else{
            $this->error(-1,'非法操作');
        }
    }

    public function money_history(Request $request){
        $this->setCurUrl($request);
        $moneyList = MoneyRecord::getMoneyRecordList($request,$this->getUser()['id']);
        return view('front.user.money_history',['moneyList'=>$moneyList]);
    }

    public function allusers(Request $request){
        $this->setCurUrl($request);
        $userList = User::getAllUsers($request);
        return view('front.user.allusers',['userList'=>$userList,'request'=>$request]);
    }

    public function myusers(Request $request){
        $this->setCurUrl($request);
        $userList = User::getAllUsers($request,$this->getUser()['id']);
        return view('front.user.myusers',['userList'=>$userList,'request'=>$request]);
    }

}
