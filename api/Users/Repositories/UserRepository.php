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
