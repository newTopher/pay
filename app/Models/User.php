<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;

class User extends Model{

    const DELETED_AT = null;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    const USER_STATUS_IS_ACTIVE = 1;
    const USER_STATUS_NOT_ACTIVE  = 0;
    const ROLE_TYPE_ADMIN = 0;
    const ROLE_TYPE_NOMAL_MEMBER = 1;
    const ROLE_TYPE_AGENT = 2;

    protected $table = 'spay_user';

    static public function store(Request $request){
        $user = new self();

        $user->email = $request->inputEmail;
        $user->name = $request->inputRealName;
        $user->wechat = $request->inputWeixin;
        $user->salt = self::salt();
        $user->is_active = self::USER_STATUS_NOT_ACTIVE;
        $user->role_type = self::ROLE_TYPE_NOMAL_MEMBER;
        $user->active_code = self::activeCode($user->email);
        $user->password = md5($request->inputPassword.$user->salt);
        $user->phone = $request->inputPhoneNumber;
        $user->ctime = time();
        $user->mtime = time();
        $res = $user->save();

        return $res;
    }

    static public function saveUser(Request $request){
        if($request->has('id') && $request->id){
            if($user = (new self()) ->where('id',$request->id)->first()){
                if($request->has('realname')){
                    $user->name = $request->realname;
                }
                if($request->has('mobile')){
                    $user->phone = $request->mobile;
                }
                if($request->has('weixin')){
                    $user->wechat = $request->weixin;
                }
                if($request->has('qq')){
                    $user->qq = $request->qq;
                }
                if($request->has('realname')){
                    $user->name = $request->realname;
                }

                return $user->save();
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    static public function getUserById($id){
        return (new self()) ->where('id',$id)->first();
    }

    static public function getUserByEmail($email){
        return (new self()) ->where('email',$email)->first();
    }

    static public function updateUser($id,$data=[]){
        if($user = (new self()) ->where('id',$id)->first()){
            if(isset($data['login_time'])){
                $user->login_time = $data['login_time'];
            }
            if(isset($data['login_token'])){
                $user->login_token = $data['login_token'];
            }
            if(isset($data['password'])){
                $user->password = $data['password'];
            }
            return $user->save();
        }
        return false;
    }

    static public function salt(){
        return rand(1000,9999);
    }

    static public function activeCode($namespace){
        static $guid = '';
        $uid = uniqid ( "", true );

        $data = $namespace;
        $data .= $_SERVER ['REQUEST_TIME'];     // 请求那一刻的时间戳
        $data .= $_SERVER ['HTTP_USER_AGENT'];  // 获取访问者在用什么操作系统
        $data .= $_SERVER ['SERVER_ADDR'];      // 服务器IP
        $data .= $_SERVER ['SERVER_PORT'];      // 端口号
        $data .= $_SERVER ['REMOTE_ADDR'];      // 远程IP
        $data .= $_SERVER ['REMOTE_PORT'];      // 端口信息

        $hash = strtoupper ( hash ( 'ripemd128', $uid . $guid . md5 ( $data ) ) );
        $guid =  substr ( $hash, 0, 8 ) . '-' . substr ( $hash, 8, 4 ) . '-' . substr ( $hash, 12, 4 ) . '-' . substr ( $hash, 16, 4 ) . '-' . substr ( $hash, 20, 12 );

        return $guid;
    }

    static public function getAllUsers(Request $request,$parent_uid = ''){
        $userModel = new self();
        $query = $userModel->where('id','>',0);
        if($parent_uid){
            $query->where('parent_uid',$parent_uid);
        }
        if($request->has('role_type') && $request->role_type){
            $query->where('role_type',$request->role_type);
        }
        if($request->has('email') && $request->email){
            $query->where('email',$request->email);
        }
        if($request->has('phone') && $request->phone){
            $query->where('phone',$request->phone);
        }

        $query->orderBy('ctime','desc');

        return $query->paginate(15);
    }



}