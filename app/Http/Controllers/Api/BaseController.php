<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Laravel\Lumen\Routing\Controller as SysBaseController;

class BaseController extends SysBaseController
{
    public function success($code = 1,$msg='操作成功',$data = [],$url=''){
        return response()->json([
            'code'=> $code,
            'msg'=>$msg,
            'data'=>$data
        ]);
    }

    public function error($code = -1,$msg='操作失败',$data = []){
        return response()->json([
            'code'=> $code,
            'msg'=>$msg,
            'data'=>$data
        ]);
    }

    public function validRequset(Request $request,$filter = []){
        if($all = $request->all()) {
            foreach ($all as $key => $val) {
                if(in_array($key,$filter)){
                    continue;
                }else{
                    if(!$val){
                        return $this->error(-1,'参数不能为空',['key'=>$key]);
                    }
                }
            }
        }
        return true;
    }

    public function setUser($user){
        $user = [
            'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'is_active'=>$user->is_active,
            'role_type'=>$user->role_type,
            'level'=>$user->level
        ];
        app('session')->put(Config::get('session.user_session_key'),$user);
    }

    public function getUser(){
        return app('session')->get(Config::get('session.user_session_key'));
    }

    public function destorySession(){
        app('session')->put(Config::get('session.user_session_key'),null);
    }

    public function setCurUrl(Request $request){
        app('session')->put(Config::get('session.cur_url_key'),$request->url());
    }
}
