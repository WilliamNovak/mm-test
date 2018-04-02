<?php

namespace Api\Users\Models;
use Database\Model;

/**
 * User Model.
 *
 * @author William Novak <williamnvk@gmail.com>
 */
class User extends Model {

    /**
     * @var string
     */
    public $table = 'users';
    /**
     * @var array
     */
    protected $columns = [
        'id', 'first_name', 'last_name', 'email', 'password'
    ];

    /**
     * User constructor.
     */
    public function __construct($fix = null)
    {
        parent::__construct($this);
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
