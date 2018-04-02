<?php

namespace Database;
use Database\Connections\PDO;

use Database\Interfaces\DatabaseInterface;

class Database implements DatabaseInterface {

    /**
     * @var object
     */
    protected $instance;
    /**
     * Database constructor.
     */
    public function __construct()
    {
        $db = config(DATABASE_CONFIG);
        $databaseType = $db['type'];
        switch ($databaseType) {
            case 'pdo':
                $dabaseConfig = (object) $db['pdo'];
                $this->instance = new PDO($dabaseConfig);
                break;

            default:
                break;
        }
    }

    /**
     * Get database instance.
     * @return object
     */
    protected function getInstance()
    {
        return $this->instance;
    }
}
