<?php

namespace Sclecon\Ucentor\Utils;

use Sclecon\Ucentor\Traits\Instance;

class Api
{
    use Instance;

    public function getRequestUri(string $module, string $action, array $data) : array {
        $queryString = Tools::getInstance()->arrayToQueryString($data);
        $queryString = $this->inputEncode($queryString);
        $queryString = str_replace(
            ["{module}", "{action}", "{release}", "{queryString}", "{appid}"],
            [$module, $action, Config::getInstance()->getRelease(), $queryString, Config::getInstance()->getAppid()],
            'm={module}&a={action}&inajax=2&release={release}&input={queryString}&appid={appid}');
    }

    protected function inputEncode(string $queryString) : string {
        return urlencode(Tools::getInstance()->authCode($queryString.'&agent='.md5($_SERVER['HTTP_USER_AGENT'])."&time=".time(), 'ENCODE', Config::getInstance()->getKey()));
    }
}