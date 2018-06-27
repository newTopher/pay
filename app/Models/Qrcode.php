<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use phpDocumentor\Reflection\Types\Self_;

class Qrcode extends Model{

    const DELETED_AT = null;
    const UPDATED_AT = null;
    const CREATED_AT = null;


    protected $table = 'spay_qrcode';


    static public function saveQrcode(Request $request,$uid,$money=0,$type){
        if(!$uid || !$type){
            return false;
        }
        $hasExistData = self::getQrcodeByUidMoney($uid,$request->account_id,$money);
        if($hasExistData){
            return $hasExistData;
        }
        $qrcodeModel = new self();
        $qrcodeModel->uid = $uid;
        $qrcodeModel->money = $money;
        $qrcodeModel->type = $type;
        $qrcodeModel->qrstr = $request->qrstr;
        $qrcodeModel->qrcode_path = $request->imgname;
        $qrcodeModel->account_id = $request->account_id;

        $qrcodeModel->ctime = time();
        $qrcodeModel->mtime = time();

        $qrcodeModel->save();

        return $qrcodeModel;

    }

    static public function getQrcodeListByUid($uid){
        return (new self()) ->where('uid',$uid)->orderBy('ctime','desc')->get();
    }

    static public function getQrcodeByUidMoney($uid,$account_id,$money){
        return (new self()) ->where('uid',$uid)->where('account_id',$account_id)->where('money',$money)->orderBy('ctime','desc')->first();
    }

    static public function isSupportAnyMoneyAliWx($uid,$type,$account_id){
        return (new self()) ->where('uid',$uid)->where('account_id',$account_id)->where('money',0)->where('type',$type)->orderBy('ctime','desc')->first();
    }

    static public function isSupportMoneyAliWx($uid,$type,$account_id,$money){
        return (new self()) ->where('uid',$uid)
                                      ->where('account_id',$account_id)
                                      ->where('type',$type)
                                      ->where('money','>=',$money-Config::get('global.pay_money_range')*0.01)
                                      ->where('money','<=',$money+Config::get('global.pay_money_range')*0.01)
            ->orderBy('ctime','desc')->get();
    }

    static public function clearQrcode($type,$uid){
        if($type && $uid){
            return (new self())->where('type',$type)->where('uid',$uid)->delete();
        }
        return false;
    }

    static public function getBestQrcode($uid,$type,$price,$account_id){
        $query = (new self()) ->where('uid',$uid)
            ->where('type',$type)
            ->where('money','!=',0)
            ->where('money','>=',$price-Config::get('global.pay_money_range')*0.01)
            ->where('money','<=',$price+Config::get('global.pay_money_range')*0.01);
        if(is_array($account_id)){
            $query ->whereIn('account_id',$account_id);
        }else{
            $query ->where('account_id',$account_id);
        }
        return $query->orderBy('money','asc')->get(['id','qrcode_path','money','qrstr','account_id'])->toArray();
    }

    static public function getSelfMoneyQrcode($uid,$pay_type){
        return (new self()) ->where('uid',$uid)->where('type',$pay_type)->where('money',0)->orderBy('ctime','desc')->first();
    }



}