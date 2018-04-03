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
class EmailService {

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
     * Check e-mail service.
     *
     * @param string $email
     * @return array
     */
    public function check($email = null)
    {
        $email = strtolower(trim($email));

        /**
         * Valida e-mail string.
         */
        if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            return Response::json([
                'success' => false,
                'user' => 'invalid e-mail.'
            ], StatusCode::HTTP_BAD_REQUEST);
        }

        /**
         * Unique e-mail constraint level check.
         */
        $user = $this->userRepository->getUserByEmail($email);

        if (!empty($user)) {
            return Response::json([
                'success' => false,
                'user' => 'e-mail already in use.'
            ], StatusCode::HTTP_NOT_FOUND);
        }

        return true;

    }

}
