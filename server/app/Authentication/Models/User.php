<?php

namespace MadeiraMadeira\Application\Authentication\Models;
use Database\ORM;

/**
 * User Model.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */
class User extends ORM {

    /**
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'password', 'is_admin', 'is_active'
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

    public function toObject($data)
    {
        //
    }

}
