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
    
}
