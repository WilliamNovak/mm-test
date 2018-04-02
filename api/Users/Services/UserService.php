<?php

namespace Api\Users\Services;
use Api\Users\Repositories\UserRepository;

/**
 * User Service
 *
 * @author William Novak <williamnvk@gmail.com>
 */
class UserService {

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
     * @return array
     */
    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    /**
     * Get user by id.
     * @param int $userId
     * @return array
     */
    public function getById($userId)
    {
        return $this->getRequestedUser($userId);
    }

    /**
     * Get user by id (only in this class).
     * @param int $userId
     * @return array
     */
    private function getRequestedUser($userId)
    {
        return $this->userRepository->getById($userId);
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
