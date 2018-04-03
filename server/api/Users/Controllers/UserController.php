<?php

namespace Api\Users\Controllers;

use MadeiraMadeira\Application\Http\Controller;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\Request;
use MadeiraMadeira\Application\Http\StatusCode;
use Api\Users\Services\UserService;

use MadeiraMadeira\Application\Authentication\Auth;

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
     * @var Auth
     */
    private $auth;
    /**
     * UserService constructor.
     */
    public function __construct(UserService $userService, Auth $auth)
    {
        parent::__construct();
        $this->userService = $userService;
        $this->auth = $auth;
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
    public function getById($id = 0)
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
     * Update user by id.
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update($id = 0, Request $request)
    {
        $data = $request->get('user');
        $user = $this->userService->update($id, $data);
        
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
    public function delete($id = 0)
    {
        $this->userService->delete($id);
        return Response::json([
            'success' => true
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
