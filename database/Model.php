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
     * @var string
     */
    protected $alias;
    /**
     * Database constructor.
     */
    public function __construct($model)
    {
        parent::__construct();
        $this->database = $this->instance;
        $this->model = $model;
        $this->alias = substr($this->model->table, 0, 1);
    }

    /**
     * Make `select * from {table}`
     * @return Model
     */
    public function select()
    {
        $this->sql = "SELECT {$this->alias}.* FROM {$this->model->table} AS {$this->alias} ";
        return $this;
    }

    /**
     * Make `where {$column} {$operator} {$value}`
     * @param string $column
     * @param string $operator
     * @param mixed  $value
     * @return Model
     */
    public function where($column, $operator = '=', $value)
    {
        $this->sql .= "WHERE {$this->alias}.{$column} {$operator} {$value}";
        return $this;
    }

    /**
     * Return query result data.
     * @return array
     */
    public function get()
    {
        $queryResult = $this->database->query($this->sql);
        $this->clearSql();
        return $queryResult;
    }

    /**
     * Return query result data.
     * @return array
     */
    public function first()
    {
        $queryResult = $this->database->row($this->sql);
        $this->clearSql();
        return $queryResult;
    }

    /**
     * Clear sql string.
     * @return void
     */
    private function clearSql()
    {
        $this->sql = null;
    }

    /**
     * Raw SQL.
     * @return string
     */
    public function rawSql()
    {
        dd($this->sql);
    }

}
