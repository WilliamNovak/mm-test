<?php

namespace MadeiraMadeira\Application\Authentication\Services;
use Api\Users\Repositories\UserRepository;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\StatusCode;

/**
 * Auth Service
 *
 * @author William Novak <williamnvk@gmail.com>
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
                'user' => 'user not found'
            ], StatusCode::HTTP_NOT_FOUND);
        }

        if ($user['password'] !== md5($data['password'])) {
            return Response::json([
                'success' => false,
                'user' => 'invalid password'
            ], StatusCode::HTTP_BAD_REQUEST);
        }

        return $user;
    }

}
