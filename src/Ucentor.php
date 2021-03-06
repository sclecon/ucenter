<?php

namespace Sclecon\Ucentor;

use Sclecon\Ucentor\Module\Api;
use Sclecon\Ucentor\Module\App;
use Sclecon\Ucentor\Module\User;
use Sclecon\Ucentor\Utils\Config;

class Ucentor
{
    public function __construct(array $config){
        Config::getInstance()->verification($config);
    }

    public function user() : User {
        return User::getInstance();
    }

    public function app() : App {
        return App::getInstance();
    }

    public function api() : Api {
        return Api::getInstance();
    }


}