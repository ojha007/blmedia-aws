<?php


namespace Modules\Backend\Exceptions;

use Exception;

class InvalidMetaTags extends Exception
{
    public static function create(): self
    {
        return new self("The meta information  is invalid");
    }
}
