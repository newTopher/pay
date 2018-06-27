<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthUserMiddleware
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
        if(isset($request->param['token']) && $request->param['token']){
            $user = User::where('login_token',$request->param['token'])->first();
            if($user) {
                $request->user = [];
                $request->user['uid'] = $user->id;
                $response = $next($request);
                return $response;
            }else{
                return response()->json([
                    'code'=> -996,
                    'msg'=>'request api error'
                ]);
            }
        }
    }
}
