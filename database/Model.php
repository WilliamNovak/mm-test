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
    public function __construct()
    {
        parent::__construct();
        $this->database = $this->instance;
    }

    /**
     * Define model.
     * @param object $model
     * @return void
     */
    public function setModel($model)
    {
        $this->model = $model;
        // Define alias (the first letter of table attribute of related model).
        // TODO add another function or create a another class to collect the alias and do not create equals alias.
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
        if (preg_match('/\bWHERE\b/', $this->sql)) {
            $this->sql .= " AND ";
        } else {
            $this->sql .= " WHERE ";
        }
        $this->sql .= "{$this->alias}.{$column} {$operator} {$value} ";
        return $this;
    }

    /**
     * Return query result data.
     * @return array
     */
    public function get()
    {
        $this->formatQuery();
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
        $this->formatQuery();
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
     * Clean sql string.
     * Execute this funcion before execution of query.
     * @return void
     */
    private function formatQuery()
    {
        $this->sql = str_replace('  ', ' ', $this->sql);
    }

    /**
     * Raw SQL.
     * @return string
     */
    public function rawSql()
    {
        $this->formatQuery();
        dd($this->sql);
    }

}
