<?php

namespace Database;
use Database\Connections\PDO;

use Database\Interfaces\DatabaseInterface;

class QueryConstructor implements QueryConstructorInterface {

    /**
     * @var object
     */
    protected $instance;
    /**
     * Database constructor.
     */
    public function __construct()
    {

    }

    /**
     * Get database instance.
     * @return object
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Select
     * @return object
     */
    public function select()
    {

        return $this->instance;
    }
}
