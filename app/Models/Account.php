<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;

class Account extends Model{

    const DELETED_AT = null;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table = 'spay_user_account';


    static public function saveUserAccount($uid,$data){
        if(!$uid){
            return false;
        }
        $accountModel = new self();
        $accountModel->uid = $uid;
        if(isset($data['meal_type']) && $data['meal_type']){
            $accountModel->uid = $data['meal_type'];
        }
        if(isset($data['start_time']) && $data['start_time']){
            $accountModel->start_time = $data['start_time'];
        }
        if(isset($data['end_time']) && $data['end_time']){
            $accountModel->uid = $data['end_time'];
        }
        if(isset($data['rate']) && $data['rate']){
            $accountModel->rate = $data['rate'];
        }
        if(isset($data['money'])){
            $accountModel->money = $data['money'];
        }

        $accountModel->ctime = time();
        $accountModel->mtime = time();

        $accountModel->save();

        return $accountModel;
    }


    static public function getUserAccountByUid($uid){
        $userAccount = (new self()) ->where('uid',$uid)->first();
        if(!$userAccount){
            return self::saveUserAccount($uid,['money'=>0.00]);
        }else{
            return $userAccount;
        }
    }




}