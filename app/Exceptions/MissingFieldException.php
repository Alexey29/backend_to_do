<?php

namespace App\Exceptions;

use App\Helpers\Interfaces\ResponseCodesInterface;
use Exception;
use Throwable;

class MissingFieldException extends Exception
{
    /**
     * MissingFieldException constructor.
     * @param $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message, $code = 422, Throwable $previous = null)
    {
        $message = sprintf('Required field \'%s\' is missing!', $message);

        parent::__construct($message, $code, $previous);
    }
}
