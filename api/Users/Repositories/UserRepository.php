<?php

namespace Api\Users\Repositories;
use Api\Users\Models\User;
use Database\Database;

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
     * @var Database
     */
    private $db;
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
        return $this->user
            ->select()
            ->where('id', '=', $userId)
            # Just to test my custom ORM.
            ->where('id', '>', 0)
            # This terminate this process.
            # ->rawSql()
            ->first();
    }

    /**
     * Get one user by id column.
     *
     * @return array
     */
    public function create($data = [])
    {
        return $this->user->create($data);
    }

    /**
     * Get one user by id column.
     * @param int $userId
     * @return array
     */
    public function update($userId, $data = [])
    {
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

}
