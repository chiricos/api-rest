<?php

namespace App\Http\Middleware;

use Closure;

class ApiMiddleware
{

    public function handle($request, Closure $next)
    {
        $apikey      = $request->headers->get('api-key');
        if($apikey == env('API') and $apikey != NULL)
        {
           $checkauth=1;
            if($checkauth == 0)
            {
                $errores[]=array("field" =>'credenciales',"code" =>(int)env('COD_META_AUTORIZACION'),"message" =>'credenciales invalidas');
                $meta =array('code'=>(int)env('COD_META_AUTORIZACION'),'message'=>env('MSG_META_AUTORIZACION'));
                return response()->json(['meta'=>$meta,'errors'=>$errores], 401);
            }else{
                return $next($request);
            }
        }else{
            $errores[]=array("field" =>'api key',"code" =>(int)env('COD_META_AUTORIZACION'),"message" =>'key invalida');
            $meta =array('code'=>(int)env('COD_META_AUTORIZACION'),'message'=>env('MSG_META_AUTORIZACION'));
            return response()->json(['meta'=>$meta,'errors'=>$errores], 401);
        }
    }
}
