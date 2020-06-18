<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class EntityNotFoundException extends Exception
{
    /**
     * EntityNotFoundException constructor.
     * @param $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message, $code = 404, Throwable $previous = null)
    {
        $message = sprintf('Entity \'%s\' doesn\'t exist!', $message);

        parent::__construct($message, $code, $previous);
    }
}
