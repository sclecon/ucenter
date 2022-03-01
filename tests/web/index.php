<?php

try {
    require __DIR__.'/../../vendor/autoload.php';

    $config = [
        'appid' =>  4,
        'api'   =>  'https://test2018.suapp.com.cn/uc_server',
        'key'   =>  'M1Qcpdo78aufo7r8v9Od7d66C044g4d0901fV6pc67h6F5HcP7e4Fd1cQ9279416',
        'charset'   =>  'utf-8',
        'ip'    =>  '119.91.103.125'
    ];

    // $response = (new \Sclecon\Ucentor\Ucentor($config))->user()->register('王二麻子1', 'xzcadmin', 'wangermazi@qq.com2');
    $response = (new \Sclecon\Ucentor\Ucentor($config))->user()->login('uctest', 'uctest');
    var_dump($response);
} catch (Exception $exception){
    echo "错误: ".$exception->getMessage().PHP_EOL;
}