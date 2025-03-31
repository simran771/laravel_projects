<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $valid_customer = $this->validate_connection_id($request->connection_id);
        if(!$valid_customer)
            return response()->json(['status'=>'error','message'=>'Invalid Connection','data'=>[]]);
        
        $valid_auth = $this->validateAuth($request->connection_id,$request->auth_code);
        if(!$valid_auth)
            return response()->json(['status'=>'error','message'=>'Unauthenticated!','data'=>[]]);
        return $next($request);
    }
}
