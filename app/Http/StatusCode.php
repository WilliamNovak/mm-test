<?php

namespace MadeiraMadeira\Application\Http;

/**
 * Application Controller
 *
 * @author William Novak <williamnvk@gmail.com>
 */
class StatusCode {

    /**
     * List of Status Http responses.
     */
    const HTTP_NOT_FOUND = 404;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_SUCCESS = 200;
    const HTTP_INTERNAL_ERROR = 500;

    /**
     * Response constructor.
     */
    public function __construct()
    {

    }

    /**
     * Checvk Status Code.
     * TODO finish this function, compare param to status code listed.
     * @param string $statusCode
     */
    public function checkStatusCode($statusCode)
    {
        return true;
    }
}
