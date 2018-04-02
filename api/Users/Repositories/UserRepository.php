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
    public function __construct(User $user, Database $database)
    {
        $this->user = $user;
        $this->db = $database->getInstance();
    }

    public function getAll()
    {
        $query = "SELECT * FROM {$this->user->table}";
        return $this->db->query($query);
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
