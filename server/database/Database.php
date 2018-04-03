<?php

namespace Database;
use Database\Connections\PDO;
use Database\Interfaces\DatabaseInterface;

define('CONFIG_DATABASE', config(DATABASE_CONFIG));
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
     * @var object
     */
    private $db;
    /**
     * @var object
     */
    private $databaseType;
    /**
     * Database constructor.
     */
    public function __construct()
    {
        $this->db = config(DATABASE_CONFIG);
        $this->databaseType = $this->db['type'];
        switch ($this->databaseType) {
            case 'pdo':
                $dabaseConfig = (object) $this->db['pdo'];
                $this->instance = new PDO($dabaseConfig);
                break;

            default:
                break;
        }
    }

    /**
     * Database constructor.
     */
    public function newInstance()
    {
        $this->db = CONFIG_DATABASE;

        $this->databaseType = $this->db['type'];

        switch ($this->databaseType) {
            case 'pdo':
                $dabaseConfig = (object) $this->db['pdo'];
                return new PDO($dabaseConfig);
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
