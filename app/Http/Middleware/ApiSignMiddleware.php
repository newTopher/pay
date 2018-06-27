<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;

class ApiSignMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        #d3GC9SrcZLWV4C9xZQXwl9KPceG4RjpSSJTeZ0JSbrkPJjGOTTWxpsO0UvV9RMIkQkhVV2RyT1dOTVVVZEVhRlU1YlZFOVBTSXNJblpoYkhWbElqb2laMmgxVGpaRlNFSkZkVlJWZFc5MGEwSXpNR1J5ZVcxcE5teDZkemxMU2pJM2VGUjFZekJhU2treFp6MGlMQ0p0WVdNaU9pSmtZamxpWVRabE9USTRabVk1TlRBek5HVmpaR0kwTVRJelpEWTNOemN4TURjNFlUWmpPVGt6TnpoaU1qTXlZMkkzTUdVMk1HWTNZbUptTmpjM056SXdJbjA9JmVtYWlsPTU3NTk1NjM4MUBxcS5jb20mcGFzc3dvcmQ9MTIzNDU2Nzg5YWEO0O0O
        #echo $this->encode("token=eyJpdiI6InBFMjNQTHBHUWdrOWNMUUdEaFU5bVE9PSIsInZhbHVlIjoiZ2h1TjZFSEJFdVRVdW90a0IzMGRyeW1pNmx6dzlLSjI3eFR1YzBaSkkxZz0iLCJtYWMiOiJkYjliYTZlOTI4ZmY5NTAzNGVjZGI0MTIzZDY3NzcxMDc4YTZjOTkzNzhiMjMyY2I3MGU2MGY3YmJmNjc3NzIwIn0=&pay_type=1&price=9.99&pay_time=1526027696&pay_extra=1234|23235|54645");die;
        #d3GC9SrcZLWV4C9xZQXwl9KPceG4RjpSSJTeZ0JSbrkPJjGOTTWxpsO0UvV9RMIkQkhVV2RyT1dOTVVVZEVhRlU1YlZFOVBTSXNJblpoYkhWbElqb2laMmgxVGpaRlNFSkZkVlJWZFc5MGEwSXpNR1J5ZVcxcE5teDZkemxMU2pJM2VGUjFZekJhU2treFp6MGlMQ0p0WVdNaU9pSmtZamxpWVRabE9USTRabVk1TlRBek5HVmpaR0kwTVRJelpEWTNOemN4TURjNFlUWmpPVGt6TnpoaU1qTXlZMkkzTUdVMk1HWTNZbUptTmpjM056SXdJbjA9JnBheV90eXBlPTEmcHJpY2U9OS45OSZwYXlfdGltZT0xNTI2MDI3Njk2JnBheV9leHRyYT0xMjM0fDIzMjM1fDU0NjQ1
        #echo $this->encode("token=eyJpdiI6InBFMjNQTHBHUWdrOWNMUUdEaFU5bVE9PSIsInZhbHVlIjoiZ2h1TjZFSEJFdVRVdW90a0IzMGRyeW1pNmx6dzlLSjI3eFR1YzBaSkkxZz0iLCJtYWMiOiJkYjliYTZlOTI4ZmY5NTAzNGVjZGI0MTIzZDY3NzcxMDc4YTZjOTkzNzhiMjMyY2I3MGU2MGY3YmJmNjc3NzIwIn0=");die;
        #d3GC9SrcZLWV4C9xZQXwl9KPceG4RjpSSJTeZ0JSbrkPJjGOTTWxpsO0UvV9RMIkQkhVV2RyT1dOTVVVZEVhRlU1YlZFOVBTSXNJblpoYkhWbElqb2laMmgxVGpaRlNFSkZkVlJWZFc5MGEwSXpNR1J5ZVcxcE5teDZkemxMU2pJM2VGUjFZekJhU2treFp6MGlMQ0p0WVdNaU9pSmtZamxpWVRabE9USTRabVk1TlRBek5HVmpaR0kwTVRJelpEWTNOemN4TURjNFlUWmpPVGt6TnpoaU1qTXlZMkkzTUdVMk1HWTNZbUptTmpjM056SXdJbjA9
        if(!$request->has('params')){
            return response()->json([
                'code'=> -999,
                'msg'=>'request api error'
            ]);
        }

        #echo $this->decode('3dCGS9crLZVWC4x9QMwT9IPzeN4DjUS2JJen0VSprZPDj0OxTMxTsE0xvM9QMO0O0OkO0O0O');die;
        $decode = $this->decode($request->params);
        if(!$decode){
            return response()->json([
                'code'=> -998,
                'msg'=>'request api error'
            ]);
        }
        $request->param = [];
        parse_str($decode,$params);
        foreach ($params as $key=>$val){
            if($key) {
                $request->param[$key] = $val;
            }
        }

        $response = $next($request);
        return $response;
    }

    /**
     * 简单对称加密算法之加密
     * @param String $string 需要加密的字串
     * @param String $skey 加密EKY
     * @author Anyon Zou <zoujingli@qq.com>
     * @date 2013-08-13 19:30
     * @update 2014-10-10 10:10
     * @return String
     */
    public function encode($string = '') {
        $strArr = str_split(base64_encode($string));
        $strCount = count($strArr);
        foreach (str_split(Config::get('global.api_key')) as $key => $value)
            $key < $strCount && $strArr[$key].=$value;
        return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
    }
    /**
     * 简单对称加密算法之解密
     * @param String $string 需要解密的字串
     * @param String $skey 解密KEY
     * @author Anyon Zou <zoujingli@qq.com>
     * @date 2013-08-13 19:30
     * @update 2014-10-10 10:10
     * @return String
     */
    public function decode($string = '') {
        $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
        $strCount = count($strArr);
        foreach (str_split(Config::get('global.api_key')) as $key => $value)
            $key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
        return base64_decode(join('', $strArr));
    }
}
