<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Self_;

class Product extends Model{

    const DELETED_AT = null;
    const UPDATED_AT = null;
    const CREATED_AT = null;


    protected $table = 'spay_product';


    static public function saveProduct(Request $request,$uid){
        if($request->has('id')){
            if($productModel = (new self()) ->where('id',$request->id)->first()){
                $productModel->product_name = $request->goodsName;
                $productModel->money = $request->goodsPrice;
                $productModel->mtime = time();
                $productModel->save();

                return $productModel;
            }else{
                return false;
            }
        }else{
            if(!$uid){
                return false;
            }
            $account = UserAccount::where('id',$request->account_id)->first();
            if(!$account){
                return false;
            }
            $productModel = new self();
            $productModel->uid = $uid;
            $productModel->account_id = $request->account_id;
            $productModel->type = $account->type;
            $productModel->product_name = $request->goodsName;
            $productModel->money = $request->goodsPrice;
            $productModel->ctime = time();
            $productModel->mtime = time();

            $productModel->save();

            return $productModel;
        }
    }

    static public function getProductListByUid($uid){
        return (new self()) ->where('uid',$uid)->where('is_del',0)->orderBy('ctime','desc')->get();
    }

    static public function getUserAccountByUid($uid){
        $userAccount = (new self()) ->where('uid',$uid)->first();
        if(!$userAccount){
            return self::saveUserAccount($uid,['money'=>0.00]);
        }else{
            return $userAccount;
        }
    }

    static public function getProductInfoByPrice($uid,$account_id,$money){
        return  (new self()) ->where('uid',$uid)->where('is_del',0)->where('account_id',$account_id)->where('money','=',$money)->first();
    }



}