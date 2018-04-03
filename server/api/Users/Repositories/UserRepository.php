<?php

namespace Api\Users\Repositories;
use MadeiraMadeira\Application\Authentication\Models\User;

/**
 * User Repository.
 *
 * @author William Novak <williamnvk@gmail.com>
 */
class UserRepository {

    /**
     * @var User
     */
    private $user;
    /**
     * UserRepository constructor.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get all users.
     *
     * @return array
     */
    public function getAll()
    {
        return $this->user->select()->get();
    }

    /**
     * Get one user by id column.
     * @param int $userId
     * @return array
     */
    public function getById($userId = 0)
    {
        return $this->user->where('id', '=', $userId)->first();
    }

    /**
     * Get one user by id column.
     *
     * @return array
     */
    public function create($data = [])
    {
        $data['password'] = md5($data['password']);
        return $this->user->create($data);
    }

    /**
     * Get one user by id column.
     * @param int $userId
     * @return array
     */
    public function update($userId, $data = [])
    {
        if (isset($data['password'])) {
            $data['password'] = md5($data['password']);
        }
        return $this->user->update($userId, $data);
    }

    /**
     * Delete user by id.
     * @param int $userId
     * @return array
     */
    public function delete($userId = 0)
    {
        return $this->user->delete($userId);
    }

    /**
     * Get one user by id column.
     * @param int $userId
     * @return array
     */
    public function getUserByEmail($userEmail = null)
    {
        if (is_null($userEmail)) {
            return false;
        }

        return $this->user->where('email', '=', $userEmail)->first();
    }

}
