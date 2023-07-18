<?php
declare(strict_types=1);

namespace app\Exceptions;

use Exception;

class ShowableException extends Exception
{
    protected $code = 551;
}