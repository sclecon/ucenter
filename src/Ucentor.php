<?php

namespace Sclecon\Ucentor;

use Sclecon\Ucentor\Module\User;
use Sclecon\Ucentor\Utils\Config;

class Ucentor
{
    public function __construct(array $config){
        Config::getInstance()->verification($config);
        echo Config::getInstance()->getAppid().PHP_EOL;
    }

    public function user(){
        return User::getInstance();
    }
}