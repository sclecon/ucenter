<?php

echo "Ucenter For Web Client <br>";

echo "<hr/>";

try {
    require __DIR__.'/../../vendor/autoload.php';

    $config = [
        'appid' =>  4,
        'api'   =>  'https://test2018.suapp.com.cn/uc_server',
        'key'   =>  'M1Qcpdo78aufo7r8v9Od7d66C044g4d0901fV6pc67h6F5HcP7e4Fd1cQ9279416',
        'charset'   =>  'utf-8',
        'ip'    =>  '119.91.103.125'
    ];

    $ucenter = new \Sclecon\Ucentor\Ucentor($config);
    $response = $ucenter->user()->register('zhangsanfeng', 'xzcadmin', 'xzcadmin@qq.com');
    var_dump($ucenter);
} catch (Exception $exception){
    echo "错误: ".$exception->getMessage().PHP_EOL;
}