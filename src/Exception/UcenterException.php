<?php

namespace Sclecon\Ucentor\Exception;

use \Throwable;

class UcenterException extends \Exception
{
    public function __construct(string $message, int $code = 550, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}