<?php

namespace App\Http\Controllers\Front;
use App\Models\Product;
use App\Models\Qrcode;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\UserApiConfig;
use App\Models\UserRecharge;
use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;
use Illuminate\Support\Facades\Config;
use Qiniu\Auth;

class AccountController extends BaseController
{

    public function account(Request $request){
        $accountList = UserAccount::getUserAccountListByUid($this->getUser()['id']);
        return view('front.account.account',['account_list'=>$accountList]);
    }

    public function account_save(Request $request){
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request,['is_enable']);
            if($valid !== true){
                return $valid;
            }
            if(($userPayAccount = UserAccount::savePayAccount($request,$this->getUser()['id'])) !== false){
                return $this->success(1,"添加成功",$userPayAccount);
            }else{
                return $this->error(-1,"添加失败请重试");
            }

        }
    }

    public function account_opt(Request $request){
        if($request->isMethod('POST')){
            if(($userPayAccount = UserAccount::optAccount($request,$this->getUser()['id'])) !== false){
                return $this->success(1,"操作成功",$userPayAccount);
            }else{
                return $this->error(-1,"操作失败请重试");
            }

        }
    }


    public function goods(Request $request){
        $accessKey = Config::get('global.qiniu_key');
        $secretKey = Config::get('global.qiniu_secret');
        $bucket = Config::get('global.qiniu_bucket');
        // 初始化Auth状态
        $auth = new Auth($accessKey, $secretKey);
        // 简单上传凭证
        $expires = 3600;
        $policy = null;
        $upToken = $auth->uploadToken($bucket, null, $expires, $policy, true);

        $accountList = UserAccount::getUserAccountListByUid($this->getUser()['id'])->toArray();
        if($accountList) {
            foreach ($accountList as $key => $val) {
                $accountList[$key]['is_wx'] = Qrcode::isSupportAnyMoneyAliWx($this->getUser()['id'],2,$val['id']) ? 1 : 0;
                $accountList[$key]['is_alipay'] = Qrcode::isSupportAnyMoneyAliWx($this->getUser()['id'],1,$val['id']) ? 1 : 0;
            }
        }
        $goodsList = Product::getProductListByUid($this->getUser()['id'])->toArray();
        if($goodsList){
            foreach ($goodsList as $key=>$val){
                $goodsList[$key]['wx_money'] = Qrcode::isSupportMoneyAliWx($this->getUser()['id'],2,$val['account_id'],$val['money'])->toArray();
                $goodsList[$key]['alipay_money'] = Qrcode::isSupportMoneyAliWx($this->getUser()['id'],1,$val['account_id'],$val['money'])->toArray();
                $w_i = 0;
                $w_i_arr = [];
                $w_i_well = 0;  #微信最佳
                $w_i_well_arr = [];
                $w_i_loss_arr = [];

                $a_i = 0;
                $a_i_arr = [];
                $a_i_well = 0; #阿里最佳
                $a_i_well_arr = [];
                $a_i_loss_arr = [];

                $num_arr = [];
                for ($j = 0;$j <=Config::get('global.pay_money_range'); $j++){
                    $num_arr[] = $val['money'] + $j*0.01;
                    if($val['money'] - $j*0.01 > 0) {
                        $num_arr[] = $val['money'] - $j * 0.01;
                    }
                }

                foreach ($goodsList[$key]['wx_money'] as $k=>$v){
                    if(in_array($v['money'],$num_arr)){
                        if(in_array($v['money'],[$v['money'],$v['money']-0.01,$v['money']-0.02,$v['money']+0.01,$v['money']+0.02])){
                            if(!in_array($v['money'],$w_i_well_arr)){
                                $w_i_well_arr[] = $v['money'];
                            }
                            $w_i_well = $w_i_well + 1;
                        }
                        $w_i = $w_i +1;
                        if(!in_array($v['money'],$w_i_arr)){
                            $w_i_arr[] = $v['money'];
                        }
                    }
                }
                foreach ($goodsList[$key]['alipay_money'] as $k=>$v){
                    if(in_array($v['money'],$num_arr)){
                        if(in_array($v['money'],[$v['money'],$v['money']-0.01,$v['money']-0.02,$v['money']+0.01,$v['money']+0.02])){
                            if(!in_array($v['money'],$a_i_well_arr)){
                                $a_i_well_arr[] = $v['money'];
                            }
                            $a_i_well = $a_i_well + 1;
                            if(!in_array($v['money'],$a_i_arr)){
                                $a_i_arr[] = $v['money'];
                            }
                        }
                        $a_i = $a_i +1;
                    }
                }

                foreach ([$val['money'],$val['money']-0.01 ? $val['money']-0.01 : 0,$val['money']-0.02 ? $val['money']-0.02 : 0,$val['money']+0.01,$val['money']+0.02] as $v){
                    if(!in_array($v,$w_i_arr)){
                        $w_i_loss_arr[] = $v;
                    }
                }

                foreach ([$val['money'],$val['money']-0.01 ? $val['money']-0.01 : 0,$val['money']-0.02 ? $val['money']-0.02 : 0,$val['money']+0.01,$val['money']+0.02] as $v){
                    if(!in_array($v,$a_i_arr)){
                        $a_i_loss_arr[] = $v;
                    }
                }

                $goodsList[$key]['w_i'] = $w_i;
                $goodsList[$key]['w_i_arr'] = array_sort($w_i_arr);
                $goodsList[$key]['w_i_well'] = $w_i_well;
                $goodsList[$key]['w_i_well_arr'] = array_sort($w_i_well_arr);
                $goodsList[$key]['w_i_loss_arr'] = array_sort($w_i_loss_arr);

                $goodsList[$key]['a_i'] = $a_i;
                $goodsList[$key]['a_i_arr'] = array_sort($a_i_arr);
                $goodsList[$key]['a_i_well'] = $a_i_well;
                $goodsList[$key]['a_i_well_arr'] = array_sort($a_i_well_arr);
                $goodsList[$key]['a_i_loss_arr'] = array_sort($a_i_loss_arr);

            }
        }
        $accountIdMapList = $this->arrChangeKey($accountList);


        return view('front.account.goods',[
            'account_list'=>$accountList,
            'goods_list'=>$goodsList,
            'account_id_map_list'=>$accountIdMapList,
            'upToken'=>$upToken
        ]);
    }

    public function addqrcode(Request $request){
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request,['is_enable']);
            if($valid !== true){
                return $valid;
            }

            $baiduAIPath = ROOT_PATH.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."baiduAI";
            require_once $baiduAIPath.DIRECTORY_SEPARATOR."AipOcr.php";
            $client = new \AipOcr(Config::get('global.baidu_app'), Config::get('global.baidu_key'),  Config::get('global.baidu_secret'));
            $readData = $client->basicGeneral(file_get_contents(Config::get('global.qiniu_url')."/".$request->imgname));
            if(!$readData || !isset($readData['words_result_num']) || $readData['words_result_num'] <= 0 || !isset($readData['words_result'])){
                return $this->error(-5,"此二维码未识别请上传正确的二维码");
            }
            $payAccount = UserAccount::where('id',$request->account_id)->first();

            if($payAccount){
                if($readData['words_result'] && isset($readData['words_result'][2]) && $readData['words_result'][2]['words'] == 'ALIPAY'){
                    $payType = 1;
                    if($payAccount->type != $payType){
                        return $this->error(-1,"该账户为微信账户请上传微信收款二维码");
                    }
                    $qrcodeMoney = 0;
                    foreach ($readData['words_result'] as $key=>$val){
                        if(strpos($val['words'],'￥') !== false){
                            $qrcodeMoney = $readData['words_result'][$key]['words'];
                            $qrcodeMoney = ltrim($qrcodeMoney,'￥');
                            break;
                        }
                    }

                }elseif($readData && isset($readData['words_result'][0])
                    && $readData['words_result'][0]['words'] == '推荐使用微信支付'){
                    $payType = 2;
                    if($payAccount->type != $payType){
                        return $this->error(-1,"该账户为支付宝付账户请上传支付宝收款二维码");
                    }
                    $qrcodeMoney = 0;
                    foreach ($readData['words_result'] as $key=>$val){
                        if(strpos($val['words'],'￥') !== false){
                            $qrcodeMoney = $readData['words_result'][$key]['words'];
                            $qrcodeMoney = ltrim($qrcodeMoney,'￥');
                            break;
                        }
                    }
                }elseif($readData && isset($readData['words_result'][3]) && $readData['words_result'][3]['words'] == '微信支付'){
                    $payType = 2;
                    if($payAccount->type != $payType){
                        return $this->error(-4,"该账户为支付宝付账户请上传支付宝收款二维码");
                    }
                    $qrcodeMoney = 0;
                }else{
                    return $this->error(-3,"此二维码未识别请上传正确的二维码");
                }

                if(Qrcode::saveQrcode($request,$this->getUser()['id'],$qrcodeMoney,$payAccount->type)){
                    return $this->success(1,"添加成功");
                }else{
                    return $this->error(-2,"系统繁忙请稍后再试");
                }
            }else{
                return $this->error(-1,"非法请求");
            }

        }
    }

    public function addgoods(Request $request){
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request,['is_enable']);
            if($valid !== true){
                return $valid;
            }
            if(($userProduct= Product::saveProduct($request,$this->getUser()['id'])) !== false){
                return $this->success(1,"添加成功",$userProduct);
            }else{
                return $this->error(-1,"添加失败请重试");
            }

        }
    }

    public function clear_qrcode(Request $request){
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request);
            if($valid !== true){
                return $valid;
            }
            if(($userProduct= Qrcode::clearQrcode($request->type,$this->getUser()['id'])) !== false){
                return $this->success(1,"清除成功",$userProduct);
            }else{
                return $this->error(-1,"清除失败请重试");
            }

        }
    }

    public function clear_account(Request $request){
        if($request->isMethod('POST')){
            $valid = $this->validRequset($request);
            if($valid !== true){
                return $valid;
            }
            if(($userProduct= UserAccount::clearAccount($request->type,$this->getUser()['id'])) !== false){
                return $this->success(1,"清除成功",$userProduct);
            }else{
                return $this->error(-1,"清除失败请重试");
            }

        }
    }



}