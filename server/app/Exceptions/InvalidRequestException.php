<?php

namespace MadeiraMadeira\Application\Exceptions;

/**
 * Custom exception.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */
class InvalidRequestException extends CustomException
{
    /**
     * ConfigNotFoundException constructor.
     */
    public function __construct($message = null, $code = 500)
    {
        parent::__construct($message, $code);
    }

}
