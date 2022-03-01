<?php

namespace Sclecon\Ucentor\Module;

use Sclecon\Ucentor\Exception\UcenterException;
use Sclecon\Ucentor\Traits\Instance;
use Sclecon\Ucentor\Utils\Config;
use Sclecon\Ucentor\Utils\Tools;
use Sclecon\Ucentor\Utils\Verify;

class Api
{
    use Instance;

    protected $actions = [
        'test',
        'synlogin',
        'synlogout',
    ];

    protected $success = 1;

    protected $fail = -1;

    public function handle() : string {
        $_GET_DATA = Verify::getInstance()->apiCode(empty($_GET['code']) ? '' : $_GET['code']);
        Verify::getInstance()->apiTime(empty($_GET_DATA['time']) ? 0 : $_GET_DATA['time']);
        if (in_array(empty($_GET_DATA['action']) ? 0 : $_GET_DATA['action'], $this->actions) === false){
            throw new UcenterException('Invalid Request -1');
        }
        $action = $_GET_DATA['action'];
        if (in_array($action, get_class_methods($this)) === false){
            throw new UcenterException('Invalid Request -2');
        }
        $_POST_DATA = Tools::getInstance()->xmlToArray(file_get_contents('php://input'));
        return $this->$action($_GET_DATA, $_POST_DATA);
    }

    protected function test() : string {
        return $this->success;
    }

    protected function synlogin($get, $post) : string {
        $user_id = $get['uid'];
        $response = $this->make('synlogin')->synlogin($user_id);
        return $response === false ? $this->fail : $this->success;
    }

    protected function synlogout() : string {
        $response = $this->make('synlogout')->synlogout();
        return $response === false ? $this->fail : $this->success;
    }

    private function make($action){
        $handler = Config::getInstance()->getHandler($action);
        if ($handler === false){
            throw new UcenterException('未配置处理逻辑');
        } else if (class_exists($handler) === false){
            throw new UcenterException('接口处理类配置错误');
        } else if (in_array($action, get_class_methods($handler)) === false){
            throw new UcenterException($handler.'中未定义同名'.$action.'模块');
        }
        return new $handler();
    }
}