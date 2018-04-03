<?php

namespace MadeiraMadeira\Application\Http;
use MadeiraMadeira\Application\Exceptions\InvalidRequestException;

/**
 * Http Request Class.
 *
* @author William Novak <williamnvk@gmail.com>

 * @method public get()
 */
class Request {

    /**
     * Response constructor.
     */
    public function __construct()
    {

    }

    /**
     * Get post vars.
     * @access public
     * @return array
     */
    public static function get($key = null)
    {
        $postData = json_decode(file_get_contents('php://input'), true);

        if ( is_null($key) || !array_key_exists($key, $postData) ) {
            throw new InvalidRequestException("Invalid post data or key not found on inputed vars.");
        }

        if ( !is_null($key) && array_key_exists($key, $postData) ) {
            return $postData[$key];
        }

        return $postData;
    }

}
