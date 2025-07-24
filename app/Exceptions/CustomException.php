<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected $status;
    protected $timestamp;

    public function __construct(string $message, int $status = 400)
    {
        parent::__construct($message);
        $this->status = $status;
        $this->timestamp = now();
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
