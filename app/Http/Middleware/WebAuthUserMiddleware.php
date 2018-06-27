<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class WebAuthUserMiddleware
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
        $user = app('session')->get(Config::get('session.user_session_key'));
        if($user) {
            $response = $next($request);
            return $response;
        }else{
            return redirect()->to(url('index/index'));
        }
    }
}
