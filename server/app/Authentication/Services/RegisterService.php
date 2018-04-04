<?php

namespace MadeiraMadeira\Application\Authentication\Services;
use Api\Users\Repositories\UserRepository;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\StatusCode;

/**
 * Register Service.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
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
         * Custom validators.
         */
        if ( !isset($data['email']) || !isset($data['first_name']) || !isset($data['last_name']) || !isset($data['password']) ) {
            return Response::json([
                'success' => false,
                'message' => 'email, first name, last name or password not informed.'
            ], StatusCode::HTTP_BAD_REQUEST);
        }

        if ( !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return Response::json([
                'success' => false,
                'message' => 'invalid e-mail.'
            ], StatusCode::HTTP_BAD_REQUEST);
        }

        $data['email'] = strtolower(trim($data['email']));
        $data['password'] = md5($data['password']);

        /**
         * Force user registered outside application, to NO ADMIN role.
         */
        $data['is_admin'] = 1;
        /**
         * Force user is active.
         */
        $data['is_active'] = 1;

        /**
         * Unique e-mail constraint level check.
         */
        $user = $this->userRepository->getUserByEmail($data['email']);

        if (!empty($user)) {
            return Response::json([
                'success' => false,
                'message' => 'e-mail already in use.'
            ], StatusCode::HTTP_NOT_FOUND);
        }

        return $this->userRepository->create($data);

    }

}
