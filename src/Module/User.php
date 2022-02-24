<?php

namespace Sclecon\Ucentor\Module;

use Sclecon\Ucentor\Traits\Instance;

class User
{
    use Instance;

    public function register(string $username, string $password, string $email){

    }

    public function login(string $username, string $password){

    }

    public function logout(int $user_id){

    }

    public function edit($password){

    }

    public function del(int $user_id){

    }

}