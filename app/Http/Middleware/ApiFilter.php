<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
class ApiFilter
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
       // echo date('Y-m-d H:i:s');die;
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $uri = $_SERVER['REQUEST_URI'];
        $md5_ua = substr(md5($ua),0,5);
        $md5_uri = substr(md5($uri),0,5);
        $key = 'count:uri:'.$md5_uri.':'.$md5_ua;
        echo $key; echo '<br>';

        $count = Redis::get($key);
        echo '当前访问次数：'.$count;

        $max = env('COUNT');
        if($count>$max){
            echo '超过访问次数';
            Redis::expire($key,env('API_TIMEOUT'));
            die;
        }
        Redis::incr($key);
        echo '<hr>';
        return $next($request);
    }
}
