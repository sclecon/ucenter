# ucenter
Discuz框架的Ucenter客户端扩展，理论支持thinkphp、hyperf等第三方框架。

## 接入UC用户中心
接入UC的用户中心我们需要定义配置参数然后对客户端类进行实例化
### 定义配置参数
    $config = [
        'appid' =>  'your appid',
        'api'   =>  'your uc_server url',
        'key'   =>  'your app key',
        'charset'   =>  'utf-8',
        'ip'    =>  'your uc_server ip',
        'headler'    =>  [
            'synlogin'    =>  \Sclecon\Ucentor\Examples\Api::class,
            'synlogout'    =>  \Sclecon\Ucentor\Examples\Api::class,
        ]
    ];
### 调用用户处理
用户处理目前支持以下八个用户相关行为处理`register`、`login`、`profile`、`edit`、`synLogin`、`logout`、`delete`、`deleteAvatar`。具体操作示例请查看`tests/web/index.php`代码
#### 调用演示
    // 演示一下如何接入UC注册用户
    $config = [...];
    $username = 'sclecon';
    $password = 'scleconpassowrd';
    $email = 'sclecon@admin.com';
    $response = (new \Sclecon\Ucentor\Ucentor($config))
        ->user()
        ->register($username, $password, $email);
    var_dump($response);

## 获取应用情况
客户端支持通过`API`获取`Ucenter`中所有的客户端情况
### 调用示例
    $config = [...];
    $response = (new \Sclecon\Ucentor\Ucentor($config))
        ->app()
        ->list();
    var_dump($response);

## uc/api.php
`uc/api.php`接口只接收`synlogin`、`synlogout`三个action请求
### 配置api请求
配置参数重填写`headler`数组，您需要在`headler`的对应`action`子项中指定处理类，处理类中必须包含`action`处理函数
#### 配置参数示例
    $config = [
        'appid' =>  'your appid',
        'api'   =>  'your uc_server url',
        'key'   =>  'your app key',
        'charset'   =>  'utf-8',
        'ip'    =>  'your uc_server ip',
        'headler'    =>  [
            'synlogin'    =>  \Sclecon\Ucentor\Examples\Api::class,
            'synlogout'    =>  \Sclecon\Ucentor\Examples\Api::class,
        ]
    ];
### uc/api.php定义
您可以在`controller`中定义一个可请求方法，然后通过路由`Router`重写访问地址为`uc/api.php`，最后请求方式不进行限制或设置为`ALL`
#### 处理函数示例逻辑
    $config = [...];
    $response = (new \Sclecon\Ucentor\Ucentor($config))->api()->handle();
    echo $response;