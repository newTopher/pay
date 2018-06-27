<?php

namespace App\Http\Controllers\Front;
use App\Common\Log;
use App\Models\Account;
use App\Models\UserAccount;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\Front\BaseController;
use Illuminate\Support\Facades\Schema;

class IndexController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function index(Request $request){
        $this->setCurUrl($request);
        if($this->getUser()){
            $money = Account::getUserAccountByUid($this->getUser()['id'])->money;
        }else{
            $money = 0;
        }
        return view('front.index.index',['money'=>$money]);
    }

    public function appdownload(Request $request){
        $this->setCurUrl($request);
        return view('front.index.appdownload');
    }

    public function app_miui(Request $request){
        $this->setCurUrl($request);
        return view('front.index.app_miui');
    }

    public function app_oppo(Request $request){
        $this->setCurUrl($request);
        return view('front.index.app_oppo');
    }

    public function app_huawei(Request $request){
        $this->setCurUrl($request);
        return view('front.index.app_huawei');
    }

    public function app_vivo(Request $request){
        $this->setCurUrl($request);
        return view('front.index.app_vivo');
    }

    public function app_samsung(Request $request){
        $this->setCurUrl($request);
        return view('front.index.app_samsung');
    }

    public function app_meizu(Request $request){
        $this->setCurUrl($request);
        return view('front.index.app_meizu');
    }

    public function app_zte(Request $request){
        $this->setCurUrl($request);
        return view('front.index.app_zte');
    }

    public function app_lg(Request $request){
        $this->setCurUrl($request);
        return view('front.index.app_lg');
    }

    public function docindex(Request $request){
        $this->setCurUrl($request);
        return view('front.index.docindex');
    }

    public function docpay(Request $request){
        $this->setCurUrl($request);
        return view('front.index.docpay');
    }

    public function docgetinfo(Request $request){
        $this->setCurUrl($request);
        return view('front.index.docgetinfo');
    }

    public function docdemo(Request $request){
        $this->setCurUrl($request);
        return view('front.index.docdemo');
    }

    public function faqindex(Request $request){
        $this->setCurUrl($request);
        return view('front.index.faqindex');
    }

    public function faqused(Request $request){
        $this->setCurUrl($request);
        return view('front.index.faqused');
    }

    public function about(Request $request){
        $this->setCurUrl($request);
        return view('front.index.about');
    }

    public function demopay(){

    }
}
