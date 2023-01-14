<?php

namespace core;

class Error
{
    public $code;
    public $message;

    public function __construct($code, $message = null)
    {
        $this->code = $code;
        $this->message = $message;
    }
}