<?php

namespace MadeiraMadeira\Application\Exceptions;

/**
 * Custom exception.
 *
 * @author William Novak <williamnvk@gmail.com>
 */
class AuthFailureException extends CustomException
{
    /**
     * ConfigNotFoundException constructor.
     */
    public function __construct($message = null, $code = 401)
    {
        parent::__construct($message, $code);
    }

}
