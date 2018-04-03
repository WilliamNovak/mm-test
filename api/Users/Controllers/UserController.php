<?php

namespace Api\Users\Controllers;

use MadeiraMadeira\Application\Http\Controller;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\Request;
use MadeiraMadeira\Application\Http\StatusCode;
use Api\Users\Services\UserService;

/**
 * User Controller.
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
     * Get all users.
     *
     * @return Response
     */
    public function getAll()
    {
        $users = $this->userService->getAll();

        return Response::json([
            'success' => true,
            'users' => $users
        ], StatusCode::HTTP_SUCCESS);
    }

    /**
     * Get one user by id.
     * @param int $id
     * @return Response
     */
    public function getById($id)
    {
        $user = $this->userService->getById($id);

        return Response::json([
            'success' => true,
            'user' => $user
        ], StatusCode::HTTP_SUCCESS);
    }

    /**
     * Create user.
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $data = $request->get('user');
        $user = $this->userService->create($data);

        return Response::json([
            'success' => true,
            'user' => $user
        ], StatusCode::HTTP_SUCCESS);
    }

    /**
     * Get one user by id.
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $data = $request->get('user');
        $user = $this->userService->update($id, $data);

        return Response::json([
            'success' => true,
            'user' => $user
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
