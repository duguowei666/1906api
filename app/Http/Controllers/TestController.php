<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
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
    //发送file_get_contents get请求
    public function token(){
        $appid = 'wxc59861663d03edd7';
        $secret = '4467a4f0dcd161b26e8f921f049c5434';
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret;
        //发送请求
        $res = file_get_contents($url);
        $arr = json_decode($res,true);
        print_r($arr);
    }
    //发送curl get 请求
    public function curl1(){
        $appid = 'wxc59861663d03edd7';
        $secret = '4467a4f0dcd161b26e8f921f049c5434';
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret;
        //发送请求
        $ch = curl_init($url);            //初始化
        curl_setopt($ch,CURLOPT_HEADER,0);     //设置参数
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);     //0是浏览器自动输出 1是需要自习输出
        $res = curl_exec($ch);        //执行会话
        //      遇见错误
        $errno = curl_errno($ch);           //获取错误码
        $error = curl_error($ch);            //获取错误?信息
        if($errno > 0){
            echo '错误码:' . $errno; echo '<br>';
            echo '错误信息:' . $error;die;
        }
        curl_close($ch);       //关闭会话
        var_dump($res);
    }
    //curl发送post请求
    public function curl2(){
        $access_token = '30_LJn-vTStG4BVeJCcL_6yx-5Q4sw8XKoBxjk0Z_TSXn2ucE_6vS36-Ko1inhCE0Nvhm67dC1-vD0UT9Q666rneXvjWjB4_x8tnCo5XJd-6dsicEDjY3mnFoRR5XYz-BNqie7pIziLqpVqonY8IMMeABAQUU';
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;
        $menu = [
            "button"    => [
                [
                    'type'  => 'click',
                    'name'  => 'curl',
                    'key'   => 'curl001'
                ]
            ]
        ];
        //初始化
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_HEADER,0);     //设置参数
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);     //0是浏览器自动输出 1是需要自习输出
        //发送post请求
        curl_setopt($ch,CURLOPT_POST,true);
        //发送json数据
        curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type: application/json']);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($menu));
        //执行curl会话
        $res = curl_exec($ch);
        //遇见错误
        $errno = curl_errno($ch);           //获取错误码
        $error = curl_error($ch);            //获取错误?信息
        if($errno > 0){
            echo '错误码:' . $errno; echo '<br>';
            echo '错误信息:' . $error;die;
        }
        curl_close($ch);       //关闭会话
        var_dump($res);
    }
    //发送Guzzle get请求
    public function guzzle1(){
        $appid = 'wxc59861663d03edd7';
        $secret = '4467a4f0dcd161b26e8f921f049c5434';
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret;
        //发送请求
        $client = new Client();
        $res = $client->request('GET',$url);
        $data = $res->getBody();    //获取响应的数据
        echo $data;
    }
}
