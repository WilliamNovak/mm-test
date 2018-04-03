<?php

namespace Api\Contacts\Models;
use Database\ORM;

/**
 * Contact Model.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */
class Contact extends ORM {

    /**
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'mobile', 'address', 'user_id'
    ];
    /**
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];

    /**
     * Contact constructor.
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
    
    //
    // public function user()
    // {
    //     return new MadeiraMadeira\Application\Authentication\Models\User;
    // }

}
