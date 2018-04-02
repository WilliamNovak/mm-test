<?php

namespace Api\Users\Models;

/**
 * User Model
 *
 * @author William Novak <williamnvk@gmail.com>
 */
class User {

    /**
     * @var string
     */
    protected $table = 'users';
    /**
     * User constructor.
     */
    public function __construct()
    {

    }

    public function getById($id)
    {

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
