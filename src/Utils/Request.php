<?php

namespace Sclecon\Ucentor\Utils;

use Sclecon\Ucentor\Traits\Instance;

class Request
{
    use Instance;

    public function send(string $module, string $action, array $data = [], array $header = []) {
        $uri = Api::getInstance()->getRequestUri($module, $action, $data);
        $api = Config::getInstance()->getApi().'/index.php';
        $ip = Config::getInstance()->getIp();
        return $this->uc_fopen2($api, 500000, $uri, '', TRUE, $ip, 20);
    }

    protected function uc_fopen2($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE) {
        $__times__ = isset($_GET['__times__']) ? intval($_GET['__times__']) + 1 : 1;
        if($__times__ > 2) {
            return '';
        }
        $url .= (strpos($url, '?') === FALSE ? '?' : '&')."__times__=$__times__";
        return uc_fopen($url, $limit, $post, $cookie, $bysocket, $ip, $timeout, $block);
    }

    protected function exec(string $uri = ''){

    }

}