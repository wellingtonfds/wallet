<?php

namespace App\Exceptions;

use Exception;

class NotifyAccountException extends Exception
{
    protected $message = 'Not possible notify the payee, but transaction has been cancelled';
}
