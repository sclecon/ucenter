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

    /**
     * @var string
     */
    protected $release = '20141101';

    /**
     * @var string
     */
    protected $version = '1.6.0';

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

    public function getKey() : string {
        if (is_null($this->key) or strlen($this->key) == 0){
            throw new UcenterException('UC密钥错误');
        }
        return $this->key;
    }

    public function getApi() : string {
        if (is_null($this->api) or strlen($this->api) == 0){
            throw new UcenterException('Api配置错误');
        }
        return $this->api;
    }

    public function getAppid() : string {
        if (is_null($this->appid) or strlen($this->appid) == 0){
            throw new UcenterException('Appid配置错误');
        }
        return $this->appid;
    }

    public function getRelease() : string {
        return $this->release;
    }

    public function getIp() : string {
        if (is_null($this->ip) or strlen($this->ip) == 0){
            throw new UcenterException('IP配置错误');
        }
        return $this->ip;
    }

    public function __call($function, $args){
        $function = strtolower(str_replace('get', '', $function));
        if (isset($this->$function)){
            return $this->$function;
        }
    }
}