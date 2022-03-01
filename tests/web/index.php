<?php

try {
    require __DIR__.'/../../vendor/autoload.php';

    $config = [
        'appid' =>  'your appid',
        'api'   =>  'your uc_server url',
        'key'   =>  'your app key',
        'charset'   =>  'utf-8',
        'ip'    =>  'your uc_server ip',
        'handler'    =>  [
            'synlogin'    =>  \Sclecon\Ucentor\Examples\Api::class, // 同步登录处理逻辑定义
            'synlogout'    =>  \Sclecon\Ucentor\Examples\Api::class,    // 同步退出处理逻辑定义
        ]
    ];

    // $response = (new \Sclecon\Ucentor\Ucentor($config))->user()->register('ucttt', 'ucttt', 'ucttt@qq.com');
    // $response = (new \Sclecon\Ucentor\Ucentor($config))->user()->login('大表哥', '123456');
    // $response = (new \Sclecon\Ucentor\Ucentor($config))->user()->profile('大表哥');
    // $response = (new \Sclecon\Ucentor\Ucentor($config))->user()->edit('大表哥', '', '123456', '', 1);
    // $response = (new \Sclecon\Ucentor\Ucentor($config))->user()->deleteavatar(198);
    // $response = (new \Sclecon\Ucentor\Ucentor($config))->user()->delete(198);
    // $response = (new \Sclecon\Ucentor\Ucentor($config))->user()->synLogin(234);
    // $response = (new \Sclecon\Ucentor\Ucentor($config))->user()->logout();
    // $response = (new \Sclecon\Ucentor\Ucentor($config))->app()->list();

    // 模拟外部请求uc/api.php
    $_GET = [
        'code'  =>  '3483r+E2SvPaOEZqesfxsGypXplFYRSRdwkQwYY8F4znRYQKif/utkZJqKwLrrQAO4MDxLUjPKoS+s5UdGH2DBNLz5kWdrLp0UXGnJewyR+Jd+sCoEECSJIOxu0QhoLPmcOVw3EiOn0onNJ+EgEIw8KN55Idc9qU1kpg',
        'time'  =>  '1646116729'
    ];

    $response = (new \Sclecon\Ucentor\Ucentor($config))->api()->handle();
    var_dump($response);
} catch (Exception $exception){
    echo "错误: ".$exception->getMessage().PHP_EOL;
}