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

    public function edit(string $response) : \stdClass {
        switch (intval($response)){
            case 1: return Response::getInstance()->success('更新成功');
            case 0: return Response::getInstance()->success('没有做任何更改');
            case -1: return Response::getInstance()->error('旧密码不正确');
            case -4: return Response::getInstance()->error('Email 格式有误');
            case -5: return Response::getInstance()->error('Email 不允许注册');
            case -6: return Response::getInstance()->error('该 Email 已经被注册');
            case -7: return Response::getInstance()->error('没有做任何修改');
            case -8: return Response::getInstance()->error('该用户受保护无权限更改');
        }
        return Response::getInstance()->error('未知错误');
    }

    public function delete(string $response) : \stdClass {
        switch (intval($response)){
            case 1: return Response::getInstance()->success('删除用户成功');
            case 0: return Response::getInstance()->error('删除用户失败');
        }
        return Response::getInstance()->error('未知错误');
    }

    public function deleteavatar(string $response) : \stdClass {
        return Response::getInstance()->success('删除用户头像成功');
    }

    public function synlogin(string $response) : \stdClass {
        return Response::getInstance()->success('同步登录链接获取成功', [
            'urls'  =>  Tools::getInstance()->htmlToUrl($response)
        ]);
    }

    public function synlogout(string $response) : \stdClass {
        return Response::getInstance()->success('同步退出登录链接获取成功', [
            'urls'  =>  Tools::getInstance()->htmlToUrl($response)
        ]);
    }
}