<?php
/**
 * Created by PhpStorm.
 * User: qyxs
 * Date: 2017/7/5
 * Time: 16:38
 */

namespace app\index\controller;


class Test
{
    public function foo(){
        $args=func_get_args();
        dump($args);
    }
    public function test(){
        $data1=[
            'a'=>1,
            'b'=>2,
            'c'=>3
        ];
        $data2=['d'=>2];
        $data3='';
        $this->foo($data1);
        echo '----------------------';
        $this->foo($data2,$data3);
        echo '----------------------';
        $this->foo($data1,$data2,$data3);
    }
}