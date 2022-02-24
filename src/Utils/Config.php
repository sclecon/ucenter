<?php

namespace Sclecon\Ucentor\Utils;

use Sclecon\Ucentor\Exception\UcenterException;
use Sclecon\Ucentor\Traits\Instance;

class Config
{
    use Instance;

    /**
     * @var string
     */
    protected $appid;

    /**
     * @var string
     */
    protected $api;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $charset;

    /**
     * @var string
     */
    protected $ip;

    public function verification(array $config){
        if (!isset($config['appid'])){
            throw new UcenterException('必须传入Ucenter的Appid配置');
        }
        if (!isset($config['api'])){
            throw new UcenterException('必须传入Ucenter的Api配置');
        }
        if (!isset($config['key'])){
            throw new UcenterException('必须传入Ucenter的Key配置');
        }
        if (!isset($config['charset'])){
            throw new UcenterException('必须传入Ucenter的Charset配置');
        }
        if (!isset($config['ip'])){
            throw new UcenterException('必须传入Ucenter的Ip配置');
        }
        $this->setAppid($config['appid']);
        $this->setApi($config['api']);
        $this->setKey($config['key']);
        $this->setCharset($config['charset']);
        $this->setIp($config['ip']);
    }

    protected function setAppid(string $appid){
        $this->appid = $appid;
    }

    protected function setApi(string $api){
        $this->api = $api;
    }

    protected function setKey(string $key){
        $this->key = $key;
    }

    protected function setCharset(string $chatset){
        $this->charset = $chatset;
    }

    protected function setIp(string $ip){
        $this->ip = $ip;
    }

    public function __call($function, $args){
        $function = strtolower(str_replace('get', '', $function));
        if (isset($this->$function)){
            return $this->$function;
        }
    }
}