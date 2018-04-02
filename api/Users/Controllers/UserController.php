<?php

namespace Api\Users\Controllers;

use MadeiraMadeira\Application\Http\Controller;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\StatusCode;
use Api\Users\Services\UserService;

/**
 * User Controller
 *
 * @author William Novak <williamnvk@gmail.com>
 */
class UserController extends Controller {

    /**
     * @var UserService
     */
    private $userService;
    /**
     * UserService constructor.
     */
    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    /**
    */
    public function getAll()
    {
        $users = $this->userService->getAll();
        if (empty($users)) {
            return Response::json([
                'success' => false
            ], StatusCode::HTTP_NOT_FOUND);
        }
        return Response::json([
            'success' => true,
            'users' => $users
        ], StatusCode::HTTP_SUCCESS);
    }

    /**
    */
    public function getById($id)
    {
        $user = $this->userService->getById($id);
        return Response::json($user, StatusCode::HTTP_SUCCESS);
    }

}
