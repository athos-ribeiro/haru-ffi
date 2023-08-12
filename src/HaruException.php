<?php

declare(strict_types=1);

namespace Haru;

class HaruException extends \Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        switch($code) {
            default:
                if(!$message) {
                    $message = "Error: libharu returned " . $code;
                }
        }
        parent::__construct($message, $code, $previous);
    }
}
