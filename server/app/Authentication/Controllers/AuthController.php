<?php

namespace MadeiraMadeira\Application\Authentication\Controllers;

use MadeiraMadeira\Application\Http\Controller;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\Request;
use MadeiraMadeira\Application\Http\StatusCode;
use MadeiraMadeira\Application\Authentication\Services\AuthService;

/**
 * User Controller.
 *
 * @author William Novak <williamnvk@gmail.com>
 */
class AuthController extends Controller {

    /**
     * @var AuthService
     */
    private $authService;
    /**
     * AuthController constructor.
     */
    public function __construct(AuthService $authService)
    {
        parent::__construct();
        $this->authService = $authService;
    }

    /**
     * Create user.
     * @param Request $request
     * @return Response
     */
    public function logIn(Request $request)
    {
        $data = $request->get('auth');
        $user = $this->authService->logIn($data);

        return Response::json([
            'success' => true,
            'user' => $user
        ], StatusCode::HTTP_SUCCESS);
    }

}
