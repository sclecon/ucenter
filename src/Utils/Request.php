<?php

namespace Sclecon\Ucentor\Utils;

use GuzzleHttp\Client;
use Sclecon\Ucentor\Exception\UcenterException;
use Sclecon\Ucentor\Traits\Instance;

class Request
{
    use Instance;

    public function send(string $module, string $action, array $data = [], array $header = []) {
        $responseHandler = 'Sclecon\\Ucentor\\Utils\\Response\\'.ucfirst($module);
        if (class_exists($responseHandler) === false){
            throw new UcenterException("{$module} in Response Error");
        } else if (in_array($action, (array) get_class_methods($responseHandler)) === false){
            throw new UcenterException("{$module} in Response {$action} Error");
        }
        $uri = Api::getInstance()->getRequestUri($module, $action, $data);
        $header['user-agent'] = $_SERVER['HTTP_USER_AGENT'];
        $response = $this->exec($uri, $header);
        return $responseHandler::getInstance()->$action($response);
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