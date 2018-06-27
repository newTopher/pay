<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;

class UserAccount extends Model{

    const DELETED_AT = null;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    const USER_STATUS_IS_ACTIVE = 1;
    const USER_STATUS_NOT_ACTIVE  = 0;
    const ROLE_TYPE_ADMIN = 0;
    const ROLE_TYPE_NOMAL_MEMBER = 1;
    const ROLE_TYPE_AGENT = 2;

    protected $table = 'spay_pay_account';


    static public function savePayAccount(Request $request,$uid){
        if($request->has('id')){
            if($payAccount = (new self()) ->where('id',$request->id)->first()){
                if($request->has('type') && in_array($request->type,[1,2])){
                    $payAccount->type = $request->type;
                }else{
                    return false;
                }
                $payAccount->account_name = $request->account_name;
                $payAccount->is_enable = $request->is_enable;
                $payAccount->mtime = time();

                $payAccount->save();

                return $payAccount;
            }else{
                return false;
            }
        }else{
            if(!$uid){
                return false;
            }
            $payAccount = new self();
            $payAccount->uid = $uid;
            if($request->has('type') && in_array($request->type,[1,2])){
                $payAccount->type = $request->type;
            }else{
                return false;
            }
            $payAccount->account_name = $request->account_name;
            $payAccount->is_enable = $request->is_enable;
            $payAccount->ctime = time();
            $payAccount->mtime = time();

            $payAccount->save();

            return $payAccount;
        }
    }

    static public function getUserAccountListByUid($uid){
        return (new self()) ->where('uid',$uid)->where('is_del',0)->orderBy('ctime','desc')->get();
    }

    static public function clearAccount($type,$uid){
        if($type && $uid){
            DB::beginTransaction();
            $del_data = (new self())->where('type',$type)->where('uid',$uid)->get(['id']);
            $del_ac = (new self())->where('type',$type)->where('uid',$uid)->delete();
            $del_pro = true;
            if($del_data){
                $del_pro = Product::whereIn('account_id',$del_data)->delete();
            }
            if($del_ac !== false && $del_pro !== false){
                DB::commit();
                return true;
            }else{
                DB::rollBack();
                return false;
            }

        }
        return false;
    }

    static public function optAccount(Request $request,$uid){
        if(!$uid){
            return false;
        }
        if($request->has('id')){
            $payAccount = (new self()) ->where('id',$request->id)->first();
            $payAccount->is_enable = $request->is_enable ? 0 : 1;
            $payAccount->mtime = time();
            $payAccount->save();

            return $payAccount;
        }
        return false;

    }

    static public function getBestAccount($price,$uid,$pay_type,$priceList){
        $accoutList = (new self())->where('uid',$uid)->where('type',$pay_type)->where('is_enable',1)->where('is_del',0)->get()->toArray();
        if(!$accoutList){
            return false;
        }
        $originAccoutList = $accoutList;
        $apiConfig = UserApiConfig::getUserApiConfigByUid($uid);
        if($apiConfig->select_type == 1){
            #最合适的二维码
            $qrcode = [];

            while(count($accoutList) > 0) {
                $randmun = rand(0, count($accoutList)-1);
                $selectAccount = $accoutList[$randmun];
                unset($accoutList[$randmun]);
                $accoutList = array_values($accoutList);
                $qrcodeArr = Qrcode::getBestQrcode($uid,$pay_type,$price,$selectAccount['id']);
                if(!$qrcodeArr){
                    continue;
                }
                foreach ($qrcodeArr as $key=>$value){
                    if(in_array($value['money'],$priceList)){
                        unset($qrcodeArr[$key]);
                    }
                }
                if(!$qrcodeArr){
                    continue;
                }
                foreach ($qrcodeArr as $k=>$v){
                    if($v['money'] == $price){
                        $qrcode = $qrcodeArr[$k];
                        break;
                    }
                }
                if(!$qrcode) {
                    $qrcodeArr = array_values($qrcodeArr);
                    if(count($qrcodeArr) == 1) {
                        $qrcode = current($qrcodeArr);
                    }else{
                        $qrcode = $qrcodeArr[ceil((count($qrcodeArr)-1)/2)];
                    }
                    break;
                }
            }
            if($qrcode){
                return $qrcode;
            }else{
                return self::getQrcode($price,$uid,$pay_type,$priceList,$originAccoutList);
            }
        }else if($apiConfig->select_type == 2){

        }else{
            return self::getQrcode($price,$uid,$pay_type,$priceList,$accoutList);
        }

        return false;
    }

    static public function getQrcode($price,$uid,$pay_type,$priceList,$accoutList){
        $accountIds = [];
        $qrcode = [];
        foreach ($accoutList as $val){
            $accountIds[] = $val['id'];
        }

        $qrcodeArr = Qrcode::getBestQrcode($uid,$pay_type,$price,$accountIds);

        if(!$qrcodeArr){
            return false;
        }

        foreach ($qrcodeArr as $key=>$value){
            if(in_array($value['money'],$priceList)){
                unset($qrcodeArr[$key]);
            }
        }

        if(!$qrcodeArr){
            return Order::getSelfMoney($uid,$pay_type);
        }
        foreach ($qrcodeArr as $k=>$v){
            if($v['money'] == $price){
                $qrcode = $qrcodeArr[$k];
                break;
            }
        }

        if($qrcode){
            return $qrcode;
        }
        if($qrcodeArr) {
            $qrcodeArr = array_values($qrcodeArr);
            if(count($qrcodeArr) == 1) {
                $qrcode = current($qrcodeArr);
            }else{
                $qrcode = $qrcodeArr[ceil((count($qrcodeArr)-1)/2)];
            }
            return $qrcode;
        }else{
            return Order::getSelfMoney($uid,$pay_type);
        }
    }


}