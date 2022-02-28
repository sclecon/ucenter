<?php

namespace Sclecon\Ucentor\Utils\Response;

use Sclecon\Ucentor\Traits\Instance;
use Sclecon\Ucentor\Utils\Response;
use Sclecon\Ucentor\Utils\Tools;

class User
{
    use Instance;

    public function register(string $response) : \stdClass {
        $uid = intval($response);
        if ($uid > 0){
            return Response::getInstance()->success('注册用户成功', ['uid'=>$uid]);
        }
        switch ($uid){
            case -1: return Response::getInstance()->error('用户名不合法');
            case -2: return Response::getInstance()->error('用户名包含不允许注册的词语');
            case -3: return Response::getInstance()->error('用户名已经存在');
            case -4: return Response::getInstance()->error('Email 格式有误');
            case -5: return Response::getInstance()->error('Email 不允许注册');
            case -6: return Response::getInstance()->error('该 Email 已经被注册');
        }
        return Response::getInstance()->error('未知错误');
    }

    public function login(string $response) : \stdClass {
        $data = Tools::getInstance()->xmlToArray($response);
        var_dump($data);
        list($uid, $username, $password, $email) = json_decode($response, true);
        if ($uid > 0){
            return Response::getInstance()->success('登录账号成功', ['uid'=>$uid]);
        }
        switch ($uid){
            case -1: return Response::getInstance()->error('用户不存在，或者被删除');
            case -2: return Response::getInstance()->error('账号或密码错误');
        }
        return Response::getInstance()->error('未知错误');
    }
}