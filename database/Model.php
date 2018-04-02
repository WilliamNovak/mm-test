<?php

namespace Database;
use Database\Interfaces\ModelInterface;
use Database\Database;

/**
 * Database class.
 * This class extends Database\Database class.
 * This class implements Database\Interfaces\ModelInterface.
 * This class is my custom ORM.
 * TODO create another class or function to put funcitons to mount SQL Query, like Laravel Eloquent, Critéria etc.
 * TODO create way to genereta SQL for all databases, includin NOSQL databases.
 * TODO create documentation of this.
 *
 * @author William Novak <williamnvk@gmail.com>
 */
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
        $alias = $this->alias;
        $table = $this->model->table;
        /**
         * Display onlyy columns listed on `protected $fillable` of model instancied.
         */
        $cola = ', ' . $alias . '.'; # result: `, x.column`
        $columns = $alias . '.' . implode($cola, $this->model->fillable);
        /**
         * Make sql with vars.
         * TODO make array os arguments.
         */
        $this->sql = "SELECT {$columns} FROM {$table} AS {$alias} ";
        return $this;
    }

    /**
     * Make `where {$column} {$operator} {$value}`.
     * NOTE Multiple 'where' clausules need be add AND operator.
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
     * Execute this funcion before execution query.
     * @return void
     */
    private function formatQuery()
    {
        $this->sql = str_replace('  ', ' ', $this->sql);
    }

    /**
     * Dewbugs and die application, to raw SQL informed on the top.
     * @return string
     */
    public function rawSql()
    {
        $this->formatQuery();
        dd($this->sql);
    }

}
