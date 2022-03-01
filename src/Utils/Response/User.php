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
        list($uid, $username, $password, $email) = Tools::getInstance()->xmlToArray($response)['root']['item'];
        if ($uid > 0){
            return Response::getInstance()->success('登录账号成功', [
                'uid'   =>  $uid,
                'username'  =>  $username,
                'email'     =>  $email,
                'password'  =>  $password,
            ]);
        }
        switch ($uid){
            case -1: return Response::getInstance()->error('用户不存在，或者被删除');
            case -2: return Response::getInstance()->error('账号或密码错误');
        }
        return Response::getInstance()->error('未知错误');
    }

    public function get_user(string $response) : \stdClass {
        list($uid, $username, $email) = Tools::getInstance()->xmlToArray($response)['root']['item'];
        if ($uid > 0){
            return Response::getInstance()->success('获取用户资料成功', [
                'uid'   =>  $uid,
                'username'  =>  $username,
                'email'     =>  $email,
            ]);
        }
        return Response::getInstance()->error('用户不存在，或者被删除');
    }
}