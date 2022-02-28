<?php

namespace Sclecon\Ucentor\Module;

use Sclecon\Ucentor\Traits\Instance;
use Sclecon\Ucentor\Utils\Tools;
use Sclecon\Ucentor\Utils\Verify;
use Sclecon\Ucentor\Utils\Request;

class User
{
    use Instance;

    public function register(string $username, string $password, string $email, string $question = '', string $answer = '', string $regIp = ''){
        $salt = Tools::getInstance()->createSalt();
        $data = [
            'username'  =>  Verify::getInstance()->username($username),
            'password'  =>  Verify::getInstance()->password($password, $salt),
            'email'     =>  Verify::getInstance()->email($email),
            'question'  =>  $question,
            'answer'    =>  $answer,
            'regip'     =>  $regIp,
            'salt'      =>  $salt,
        ];
        return Request::getInstance()->send('user','register', $data);
    }

    public function login(string $username, string $password, int $isType = 0, int $question = 0, string $questionId = '', string $answer = '', string $ip = ''){
        $data = [
            'username'  =>  $username,
            'password'  =>  $password,
            'isuid'     =>  $isType,
            'checkques' =>  $question,
            'questionid'=>  $questionId,
            'answer'    =>  $answer,
            'ip'        =>  $ip,
        ];
        return Request::getInstance()->send('user','login', $data);
    }

    public function logout(int $user_id){

    }

    public function edit($password){

    }

    public function del(int $user_id){

    }

}