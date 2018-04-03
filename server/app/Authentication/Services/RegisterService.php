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
class RegisterService {

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
     * Create new user.
     * @param array $data
     * @return array
     */
    public function register($data = [])
    {
        /**
         * Custom validator.
         */
        if ( !isset($data['email']) || !isset($data['first_name']) || !isset($data['last_name']) || !isset($data['password']) ) {
            return Response::json([
                'success' => false,
                'user' => 'email, first name, last name or password not informed.'
            ], StatusCode::HTTP_BAD_REQUEST);
        }

        /**
         * Unique e-mail constraint level check.
         */
        $user = $this->userRepository->getUserByEmail($data['email']);

        if (!empty($user)) {
            return Response::json([
                'success' => false,
                'user' => 'e-mail already in use.'
            ], StatusCode::HTTP_NOT_FOUND);
        }

        return $this->userRepository->create($data);

    }

}
