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
    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'password'
    ];
    /**
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        parent::setModel($this);
    }

}
