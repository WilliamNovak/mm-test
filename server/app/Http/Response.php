<?php

namespace MadeiraMadeira\Application\Http;
use MadeiraMadeira\Application\Http\StatusCode;
/**
 * Http Response Class.
 *
* @author William Novak <williamnvk@gmail.com>

 * @method static json(array $response, int $http_status_code)
 */
abstract class Response {

    /**
     * Response constructor.
     */
    public function __construct()
    {

    }

    /**
     * Return formated json frm array.
     * @param array $response
     * #param int $http_status_code
     */
    public static function json($response = [], $http_status_code = 200)
    {
        $status_code_description = StatusCode::statusCodeDescription($http_status_code);
        header("Content-Type: application/json", true, $http_status_code);
        header("HTTP/1.1 {$http_status_code} {$status_code_description}", true, $http_status_code);

        // TODO add response headers.
        // TODO add json validation, if invalid json, throws new custom exception.
        echo json_encode($response);
        die;
    }

}
