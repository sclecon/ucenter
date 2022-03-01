<?php

namespace Sclecon\Ucentor\Module;

use Sclecon\Ucentor\Traits\Instance;
use Sclecon\Ucentor\Utils\Verify;
use Sclecon\Ucentor\Utils\Request;

class User
{
    use Instance;

    public function register(string $username, string $password, string $email, string $question = '', string $answer = '', string $regIp = ''){
        $data = [
            'username'  =>  Verify::getInstance()->username($username),
            'password'  =>  $password,
            'email'     =>  Verify::getInstance()->email($email),
            'question'  =>  $question,
            'answer'    =>  $answer,
            'regip'     =>  $regIp,
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

    public function profile(string $username, int $isType = 0){
        $data = [
            'username'  =>  $username,
            'isuid'     =>  $isType
        ];
        return Request::getInstance()->send('user', 'get_user', $data);
    }

    public function edit(string $username, string $oldPassword = '', string $newPassword = '', string $email = '', int $ignoreOldPassword = 0, string $questionId = '', string $answer = ''){
        $data = [
            'username'  =>  $username,
            'oldpw'     =>  $oldPassword,
            'newpw'     =>  $newPassword,
            'email'     =>  $email,
            'ignoreoldpw'   =>  $ignoreOldPassword,
            'questionid'    =>  $questionId,
            'answer'        =>  $answer
        ];
        return Request::getInstance()->send('user', 'edit', $data);
    }

    public function synLogin(int $user_id){
        return Request::getInstance()->send('user', 'synlogin', ['uid'=>$user_id]);
    }

    public function logout(){
        return Request::getInstance()->send('user', 'synlogout', []);
    }

    public function delete(int $user_id){
        return Request::getInstance()->send('user', 'delete', ['uid'=>$user_id]);
    }

    public function deleteAvatar(int $user_id){
        return Request::getInstance()->send('user', 'deleteavatar', ['uid'=>$user_id]);
    }

}