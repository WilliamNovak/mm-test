<?php

namespace MadeiraMadeira\Application\Exceptions;

/**
 * Custom exception.
 * 
 * @author William Novak <williamnvk@gmail.com>
 */
class ConfigNotFoundException extends CustomException
{
    /**
     * ConfigNotFoundException constructor.
     */
    public function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
    }

}
