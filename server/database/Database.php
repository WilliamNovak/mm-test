<?php

namespace Database;
use Database\Connections\PDO;
use Database\Interfaces\DatabaseInterface;

/**
 * Database class.
 * TODO add more description to this class.
 * TODO add more connection types.
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */
class Database implements DatabaseInterface {

    /**
     * @var object
     */
    protected $instance;
    /**
     * Database constructor.
     */
    public function __construct($fix = null)
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
