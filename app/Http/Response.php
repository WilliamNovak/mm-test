<?php

namespace MadeiraMadeira\Application\Http;

/**
 * Application Controller
 *
 * @author William Novak <williamnvk@gmail.com>
 */
abstract class Response {

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
     * Return formated json frm array.
     */
    public static function json($response = [], $http_status_code = 200)
    {
        header('Content-Type: application/json');
        // TODO add response headers
        // TODO add json validation
        echo json_encode($response);
        die;
    }

}
