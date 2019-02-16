<?php
/**
 * Created by PhpStorm.
 * User: hiliq
 * Date: 2019/2/15
 * Time: 20:31
 */

namespace app\index\controller;


class Test
{
    public function index(){
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
       $order = $redis->zRevRange('clicks',0,3,true);
       foreach ($order as $key => $value){
           echo $key.'<br>';
       }
    }
}