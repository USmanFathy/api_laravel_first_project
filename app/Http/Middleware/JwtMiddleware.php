<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
class JwtMiddleware extends BaseMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            return $next($request);
        } catch (Exception $check){
            if ($check instanceof Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'invalid token']);

            }elseif($check instanceof Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'invalid expired']);
            }else{
                return response()->json(['status' => 'token not found']);
            }
        }

    }
}
