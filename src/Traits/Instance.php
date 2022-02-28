<?php

namespace Sclecon\Ucentor\Traits;

trait Instance
{
    protected static $instance;

    /**
     * @return self;
     */
    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function __construct(){}
    protected function __clone(){}
}