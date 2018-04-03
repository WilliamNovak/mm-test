<?php

namespace MadeiraMadeira\Application\Http;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\StatusCode;

/**
 * Index Class.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */
class Index {

    public function __construct()
    {

    }

    public function index()
    {
        return Response::json([
            'success' => true,
            'message' => 'Welcome to Madeira Madeira REST API v1 :)'
        ], StatusCode::HTTP_SUCCESS);
    }

    /**
     * Magic method to retrive instance of this class.
     *
     * @see http://php.net/manual/en/language.oop5.magic.php#object.invoke
     */
    public function __invoke()
    {
        return;
    }

}
