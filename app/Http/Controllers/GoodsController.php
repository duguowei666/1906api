<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\GoodsModel;
class GoodsController extends Controller
{
    public function shop(){
        $id = \request()->input('id');
        $name = \request()->input('name');
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $time = time();
        $data = [
            'id'    => $id,
            'name'  => $name,
            'ua'    => $ua,
            'ip'    => $ip,
            'time'  => $time
        ];
        $res = GoodsModel::insert($data);
        dd($res);
    }
}
