<?php

try {
    require __DIR__.'/../vendor/autoload.php';

    $config = [
        'appid' =>  1,
        'api'   =>  'https://test2018.suapp.com.cn/uc_server',
        'key'   =>  'password',
        'charset'   =>  'utf-8',
        'ip'    =>  '119.91.103.125'
    ];

    $ucenter = new \Sclecon\Ucentor\Ucentor($config);
    var_dump($ucenter);
} catch (Exception $exception){
    echo "Error: ".$exception->getMessage().PHP_EOL;
}
