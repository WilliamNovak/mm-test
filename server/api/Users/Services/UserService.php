<?php

namespace Api\Users\Services;
use Api\Users\Repositories\UserRepository;
use MadeiraMadeira\Application\Http\Response;
use MadeiraMadeira\Application\Http\StatusCode;

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
        $users = $this->userRepository->getAll();

        if (empty($users)) {
            return Response::json([
                'success' => false,
                'message' => 'no have users here.'
            ], StatusCode::HTTP_NOT_FOUND);
        }

        return $users;
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
        $user = $this->userRepository->getById($userId);
        if (empty($user)) {
            return Response::json([
                'success' => false,
                'message' => 'user not found.'
            ], StatusCode::HTTP_NOT_FOUND);
        }

        return $user;
    }

    /**
     * Get user by id.
     * @param array $data
     * @return array
     */
    public function create($data = [])
    {
        return $this->userRepository->create($data);
    }

    /**
     * Update user by id.
     * @param int $userId
     * @param array $data
     * @return array
     */
    public function update($userId, $data = [])
    {
        $this->getRequestedUser($userId);
        return $this->userRepository->update($userId, $data);
    }

    /**
     * Delete user by id.
     * @param int $userId
     * @return array
     */
    public function delete($userId)
    {
        $this->getRequestedUser($userId);
        return $this->userRepository->delete($userId);
    }

}
