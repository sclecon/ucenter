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
            'synlogin'    =>  \Sclecon\Ucentor\Examples\Api::class,
            'synlogout'    =>  \Sclecon\Ucentor\Examples\Api::class,
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

    $_GET = [
        'code'  =>  '1c19auabLeREBXRmHkFkZwvsUBfyi7EdIb91PPicoRzwGMiEFtdqIDSF7whHsPG8uFwLnug9Xum4AabfwWsafgXWidnNEP7EGuclENosObmD878mTjPriScIo0fC27/mkj4Pd0w/zGBbl5tbNayWxxVnE/a4kGl1/6nd',
        'time'  =>  '1646116729'
    ];

    $response = (new \Sclecon\Ucentor\Ucentor($config))->api()->handle();
    var_dump($response);
} catch (Exception $exception){
    echo "错误: ".$exception->getMessage().PHP_EOL;
}