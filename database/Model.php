<?php

namespace Database;
use Database\Interfaces\ModelInterface;
use Database\Database;

class Model extends Database implements ModelInterface {

    /**
     * @var object
     */
    protected $model;
    /**
     * @var Database
     */
    protected $database;
    /**
     * @var string
     */
    protected $sql;
    /**
     * Database constructor.
     */
    public function __construct($model)
    {
        parent::__construct();
        $this->database = $this->instance;
        $this->model = $model;
    }

    /**
     * Make `select * from {table}`
     * @return object
     */
    public function select()
    {
        $this->sql = "SELECT * FROM {$this->model->table}";
        return $this;
    }

    /**
     * ...
     * @return array
     */
    public function get()
    {
        $queryResult = $this->database->query($this->sql);
        $this->clearSql();
        return $queryResult;
    }

    private function clearSql()
    {
        $this->sql = null;
    }

}
