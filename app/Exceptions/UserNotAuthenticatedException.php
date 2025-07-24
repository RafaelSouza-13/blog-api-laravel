<?php

namespace App\Exceptions;

use Exception;

class UserNotAuthenticatedException extends CustomException
{
    public function __construct(string $message = 'Usuário não autenticado')
    {
        parent::__construct($message, 401);
    }
}
