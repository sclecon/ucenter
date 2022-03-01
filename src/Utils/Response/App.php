<?php

namespace Sclecon\Ucentor\Utils\Response;

use Sclecon\Ucentor\Traits\Instance;
use Sclecon\Ucentor\Utils\Response;
use Sclecon\Ucentor\Utils\Tools;

class App
{
    use Instance;

    public function ls(string $response){
        $response = Tools::getInstance()->xmlToArray($response)['root']['item'];
        $data = [];
        $count = 7;
        for ($i = 0; $i < 100; $i++){
            $_key = $i*$count;
            if (empty($response[$_key]) or is_null($response[$_key])){
                break;
            }
            $data[$i] = [
                'appid' =>  str_replace(['<item id="appid">', ' '], '', trim($response[$_key])),
                'type' =>  $response[$_key+1],
                'name' =>  $response[$_key+2],
                'url' =>  $response[$_key+3],
            ];
        }
        return Response::getInstance()->success('获取应用列表成功', $data);
    }
}