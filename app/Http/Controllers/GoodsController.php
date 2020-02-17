<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    public function shop(){
        $goods_id = \request()->input('goods_id');
        $key = 'str:goods:info:'.$goods_id;
        echo 'redis:'.$key;echo '<br>';
        $cache = Redis::get($key);      //取redis
        //判断是否有缓存
        if($cache){
            echo '有';
            $goodsInfo = json_decode($cache,true);
            print_r($goodsInfo);
        }else{
            echo '没有';
            $goodsInfo = GoodsModel::where(['goods_id'=>$goods_id])->first();
            $goodsInfo = json_encode($goodsInfo->toArray());
            Redis::set($key,$goodsInfo);        //存redis
            Redis::expire($key,10);
        }
        die;
        $name = \request()->input('name');
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $time = time();
        $data = [
            'goods_id'    => $goods_id,
            'name'  => $name,
            'ua'    => $ua,
            'ip'    => $ip,
            'time'  => $time
        ];
        $res = GoodsModel::insert($data);
        $pv = GoodsModel::where(['goods_id'=>$goods_id])->count();
        echo $pv;
        echo '<br>';
        $uv = GoodsModel::where(['goods_id'=>$goods_id])->distinct('ua')->count();
        echo $uv;
        dd($res);
    }
}
