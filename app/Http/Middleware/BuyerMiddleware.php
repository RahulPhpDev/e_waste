<?php

namespace App\Http\Middleware;

use Closure;

class BuyerMiddleware
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
        if ( $request-> user()  ){
            return $next($request);
        }
       $response = ["message" => "Not a buyer user", 'success'=> false];
       return response($response, 422); 
    }
}
