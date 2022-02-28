<?php

namespace Sclecon\Ucentor\Utils;

use Sclecon\Ucentor\Traits\Instance;

class Response
{
    use Instance;

    public function error(string $msg, int $code = 500, array $data = []) : \stdClass {
        return $this->output($msg, $code, $data);
    }

    public function success(string $msg, array $data = [], int $code = 200) : \stdClass {
        return $this->output($msg, $code, $data);
    }

    protected function output(string $msg, int $code, array $data) : \stdClass {
        $response = new \stdClass();
        $response->code = $code;
        $response->msg = $msg;
        if ($data){
            $response->data = $data;
        }
        $response->flag = $code === 200;
        return $response;
    }
}