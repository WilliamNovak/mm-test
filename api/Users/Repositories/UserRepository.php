<?php

namespace Api\Users\Repositories;
use Api\Users\Models\User;

use Database\Database;
/**
 * User Repository
 *
 * @author William Novak <williamnvk@gmail.com>
 */
class UserRepository extends Database {

    /**
     * @var object
     */
    private $user;
    /**
     * UserRepository constructor.
     */
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
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
