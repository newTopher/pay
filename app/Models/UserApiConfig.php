<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;

class UserApiConfig extends Model{

    const DELETED_AT = null;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table = 'spay_user_api_setting';


    static public function saveUserApiConfig($uid,$data = []){
        if($uid){
            if($userApiConfig = (new self()) ->where('uid',$uid)->first()){
                if(isset($data['qrcode_expire_time']) && $data['qrcode_expire_time']){
                    $userApiConfig->qrcode_expire_time = $data['qrcode_expire_time'];
                }
                if(isset($data['is_paydone_enable'])){
                    $userApiConfig->is_paydone_enable = $data['is_paydone_enable'];
                }

                if(isset($data['select_type'])){
                    $userApiConfig->select_type = $data['select_type'];
                }

                if(isset($data['view_company']) && $data['view_company']){
                    $userApiConfig->view_company = $data['view_company'];
                }

                if(isset($data['view_logo']) && $data['view_logo']){
                    $userApiConfig->view_logo = $data['view_logo'];
                }

                $userApiConfig->mtime = time();

                $userApiConfig->save();

                return $userApiConfig;
            }else{
                $userApiConfig = new self();
                $userApiConfig->api_key =self::randSole(3,16,0);
                $userApiConfig->api_token =self::randSole(3,32,0);
                $userApiConfig->uid = $uid;
                $userApiConfig->ctime = time();
                $userApiConfig->mtime = time();

                $userApiConfig->save();

                return $userApiConfig;
            }
        }else{
            return false;
        }
    }


    static public function getApiConfigDataByUid($uid){
        $userApiConfig = (new self()) ->where('uid',$uid)->first();
        if(!$userApiConfig){
            $userApiConfig = new self();
            $userApiConfig->api_key =self::randSole(3,16,0);
            $userApiConfig->api_token =self::randSole(3,32,0);
            $userApiConfig->uid = $uid;
            $userApiConfig->ctime = time();
            $userApiConfig->mtime = time();
            $userApiConfig->save();
        }
        return $userApiConfig;
    }

    static public function getUserApiConfigByUid($uid){
       return (new self()) ->where('uid',$uid)->first();
    }

    static public function resetApiInfo($uid){
        if($userApiConfig = (new self()) ->where('uid',$uid)->first()){
            $userApiConfig->api_key =self::randSole(3,16,0);
            $userApiConfig->api_token =self::randSole(3,32,0);
            $userApiConfig->save();

            return $userApiConfig;
        }else{
            return self::getApiConfigDataByUid($uid);
        }
    }


    static function randSole($type = 0,$length = 18,$time=0){
        $str = $time == 0 ? '':date('YmdHis',time());
        switch ($type) {
            case 0:
                for((int)$i = 0;$i <= $length;$i++){
                    if(mb_strlen($str) == $length){
                        $str = $str;
                    }else{
                        $str .= rand(0,9);
                    }
                }
                break;
            case 1:
                for((int)$i = 0;$i <= $length;$i++){
                    if(mb_strlen($str) == $length){
                        $str = $str;
                    }else{
                        $rand = "qwertyuioplkjhgfdsazxcvbnm";
                        $str .= $rand{mt_rand(0,26)};
                    }
                }
                break;
            case 2:
                for((int)$i = 0;$i <= $length;$i++){
                    if(mb_strlen($str) == $length){
                        $str = $str;
                    }else{
                        $rand = "QWERTYUIOPLKJHGFDSAZXCVBNM";
                        $str .= $rand{mt_rand(0,26)};
                    }
                }
                break;
            case 3:
                for((int)$i = 0;$i <= $length;$i++){
                    if(mb_strlen($str) == $length){
                        $str = $str;
                    }else{
                        $rand = "123456789qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM";
                        $str .= $rand{mt_rand(0,35)};
                    }
                }
                break;
            case 4:
                for((int)$i = 0;$i <= $length;$i++){
                    if(mb_strlen($str) == $length){
                        $str = $str;
                    }else{
                        $rand = "!@#$%^&*()_+=-~`";
                        $str .= $rand{mt_rand(0,17)};
                    }
                }
                break;
            case 5:
                for((int)$i = 0;$i <= $length;$i++){
                    if(mb_strlen($str) == $length){
                        $str = $str;
                    }else{
                        $rand = "123456789qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM!@#$%^&*()_+=-~`";
                        $str .= $rand{mt_rand(0,52)};
                    }
                }
                break;
        }
        return $str;
    }



}