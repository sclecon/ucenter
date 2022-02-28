<?php

namespace Sclecon\Ucentor\Utils;

use GuzzleHttp\Client;
use Sclecon\Ucentor\Exception\UcenterException;
use Sclecon\Ucentor\Traits\Instance;

class Request
{
    use Instance;

    public function send(string $module, string $action, array $data = [], array $header = []) {
        $uri = Api::getInstance()->getRequestUri($module, $action, $data);
        $header['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
        $response = $this->exec($uri, $header);
        $data = json_decode($response, true) ?: false;
        if ($data === false){
            throw new UcenterException($response, 500);
        }
        return $data;
    }

    protected function exec(string $uri, array $header = []) : string {
        $url = str_replace(['{api}', '{_get}', '{uri}'], [Config::getInstance()->getApi(), $uri ? '?' : '', $uri], "{api}/index.php{_get}{uri}");
        $client = new Client();
        $response = $client->get($url, [
            'headers' => $header,
            // 'body' => []
        ]);
        if ($response->getStatusCode() !== 200){
            throw new UcenterException('请求出错', $response->getStatusCode());
        }
        return $response->getBody()->read($response->getBody()->getSize());
    }

}