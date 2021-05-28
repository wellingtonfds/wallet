<?php

namespace App\Exceptions;

use Exception;

class ValidationAccountException extends Exception
{
    protected $message = 'At moment is\'nt possible to validate the transaction';

}
