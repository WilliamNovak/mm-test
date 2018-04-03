<?php

namespace MadeiraMadeira\Application\Authentication\Controllers;

use MadeiraMadeira\Application\Http\Controller;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\Request;
use MadeiraMadeira\Application\Http\StatusCode;
use MadeiraMadeira\Application\Authentication\Services\RegisterService;

/**
 * Register User Controller.
 *
 * @author William Novak <williamnvk@gmail.com>
 */
class RegisterController extends Controller {

    /**
     * @var AuthService
     */
    private $registerService;
    /**
     * AuthController constructor.
     */
    public function __construct(RegisterService $registerService)
    {
        parent::__construct();
        $this->registerService = $registerService;
    }

    /**
     * Create user.
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        $data = $request->get('user');
        $user = $this->registerService->register($data);

        return Response::json([
            'success' => true,
            'user' => $user
        ], StatusCode::HTTP_SUCCESS);
    }

}
