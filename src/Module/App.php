<?php

namespace Sclecon\Ucentor\Module;

use Sclecon\Ucentor\Traits\Instance;
use Sclecon\Ucentor\Utils\Request;

class App
{
    use Instance;

    public function list(){
        return Request::getInstance()->send('app', 'ls', []);
    }
}