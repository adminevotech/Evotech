<?php

namespace App\Http\Middleware;

use App\Constants\Status_Responses;
use Closure;
use Illuminate\Http\Request;

class Verified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check()){
            $user = auth()->user();
            if($user->email_verified_at || $user->isAdmin())
            {
                return $next($request);
            }
            return jsonPayLoad(Status_Responses::UNAUTHORIZED, response_msg(Status_Responses::UNAUTHORIZED));
        }
        return jsonPayLoad(Status_Responses::FORBIDDEN, response_msg(Status_Responses::FORBIDDEN));
    }
}
