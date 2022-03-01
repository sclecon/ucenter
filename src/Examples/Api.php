<?php

namespace Sclecon\Ucentor\Examples;

class Api
{
    public function synlogin(string $user_id){
        echo '处理UID='.$user_id.'的用户同步登录';
        return true;
    }

    public function synlogout(){
        echo '删除缓存的用户登录信息';
        return true;
    }
}