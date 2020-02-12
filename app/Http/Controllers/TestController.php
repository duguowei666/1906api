<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class TestController extends Controller
{
    public function testRedis(){
        echo 11;
        $key = '1906';
        $vel = time();
        Redis::set($key,$vel);
        $res = Redis::get($key);
        echo $res;
    }
}
