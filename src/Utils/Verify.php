<?php

namespace Sclecon\Ucentor\Utils;

use Sclecon\Ucentor\Exception\UcenterException;
use Sclecon\Ucentor\Traits\Instance;

class Verify
{
    use Instance;

    public function username(string $username) : string {
        $username = htmlspecialchars(trim(stripslashes($username)));
        if (strlen($username) === 0) {
            throw new UcenterException('用户名不能为空');
        } else if (strlen($username) > 16){
            throw new UcenterException('用户名长度超过限制', 500);
        }
        return $username;
    }

    public function email(string $email) : string {
        $email = trim($email);
        if (strlen($email) == 0){
            throw new UcenterException('邮箱不能为空');
        } else if (preg_match("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i", $email) === false) {
            throw new UcenterException('邮箱格式错误');
        }
        return $email;
    }

    public function password(string $password, string $salt) : string {
        if (strlen($password) < 6){
            throw new UcenterException('密码不能低于六位');
        } else if (strlen($password) > 16) {
            throw new UcenterException('密码不能大于16位');
        }
        return md5(md5($password).$salt);
    }

    public function apiCode(string $code) : array {
        $data = [];
        parse_str(Tools::getInstance()->authCode($code, 'DECODE', Config::getInstance()->getKey()), $data);
        if (count($data) == 0){
            throw new UcenterException('Invalid Request');
        }
        return $data;
    }

    public function apiTime(string $time) : string {
        $time = time() - $time;
        if ($time > 3600){
            throw new UcenterException('Authracation has expiried');
        }
        return $time;
    }
}