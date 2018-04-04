<?php

namespace MadeiraMadeira\Application\Authentication\Services;
use Api\Users\Repositories\UserRepository;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\StatusCode;

/**
 * Auth Service.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */
class AuthService {

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * UserService constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get user by id.
     * @param int $userId
     * @return array
     */
    public function logIn($data = [])
    {
        $user = $this->userRepository->getUserByEmail($data['email']);

        if (empty($user)) {
            return Response::json([
                'success' => false,
                'message' => 'user not found.'
            ], StatusCode::HTTP_NOT_FOUND);
        }

        if ($user['password'] !== md5($data['password'])) {
            return Response::json([
                'success' => false,
                'message' => 'invalid password.'
            ], StatusCode::HTTP_BAD_REQUEST);
        }

        if ($user['is_active'] == false) {
            return Response::json([
                'success' => false,
                'message' => 'user disabled.'
            ], StatusCode::HTTP_BAD_REQUEST);
        }

        return $user;
    }

}
