<?php

namespace Api\Users\Repositories;
use Api\Users\Models\User;

use Database\Database;
/**
 * User Repository
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

    public function getAll()
    {
        return $this->user->select()->get();
    }

    public function getById($userId = 0)
    {
        return $this->user
            ->select()
            ->where('id', '=', $userId)
            ->first();
    }

}
