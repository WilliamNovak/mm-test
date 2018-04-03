<?php

namespace Database;
use Database\Interfaces\OrmInterface;
use Database\Database;

/**
 * Database class.
 * This class extends Database\Database class.
 * This class implements Database\Interfaces\OrmInterface.
 * This class is my custom ORM.
 *
 * TODO create another class or function to put funcitons to mount SQL Query, like Laravel Eloquent, Critéria etc.
 * TODO create way to genereta SQL for all databases, including NOSQL databases.
 * TODO create documentation of this.
 * TODO INTEGRATE PDO TO THIS CLASS AND ADD `BIND PARAMETERS METHOD` (IS BETTER THAN THIS).
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */
class ORM extends Database implements OrmInterface {

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
     * Alias of table, e.g: table users, alias is: u
     * @var string
     */
    protected $alias;
    /**
     * Table name.
     * @var string
     */
    protected $table;
    /**
     * Primary key.
     * @var string
     */
    protected $pk;
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
     *
     * @param object $model
     * @return void
     */
    public function setModel($model)
    {
        $this->model = $model;

        /**
         * NOTE If model dont have table attribute, create a table name be name of model.
         * TODO ATTENTION! This project add 's' (not 's' of Superman on Man of Steel movie),
         *      add 's' to create a plural of model, relative on table name.
         */
        if ( !isset($this->model->table)) {
            $model_name = (new \ReflectionClass($this->model))->getShortName();
            $this->table = strtolower($model_name).'s';
        } else {
            $this->table = $this->model->table.'s';
        }

        /**
         * Get Primary Key attribute.
         */
        if ( !isset($this->model->pk)) {
            $this->pk = 'id';
        } else {
            $this->pk = $this->model->pk;
        }

        /**
         * Define alias (the first letter of table attribute of related model).
         * TODO add another function or create a another class to collect the alias and do not create equals alias.
         */
        $this->alias = substr($this->table, 0, 1);
    }

    /**
     * Make `select * from {table}`
     *
     * @return Model
     */
    public function select()
    {
        $alias = $this->alias;
        $table = $this->table;
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
     *
     * @param string $column
     * @param string $operator
     * @param mixed  $value
     * @return Model
     */
    public function where($column, $operator = '=', $value)
    {

        if (!preg_match('/\bSELECT\b/', $this->sql)) {
            if ( !preg_match('/\bINSERT\b/', $this->sql) && !preg_match('/\bUPDATE\b/', $this->sql) && !preg_match('/\bDELETE\b/', $this->sql) ) {
                $this->select();
            }
        }

        if (preg_match('/\bWHERE\b/', $this->sql)) {
            $this->sql .= " AND ";
        } else {
            $this->sql .= " WHERE ";
        }

        if (gettype($value) === 'string') {
            $value = "'{$value}'";
        }

        $this->sql .= "{$this->alias}.{$column} {$operator} {$value} ";
        return $this;
    }

    /**
     * Return query result data.
     *
     * @return array
     */
    public function get()
    {
        $this->fix();
        $this->formatQuery();
        $queryResult = $this->database->query($this->sql);
        $this->clearSql();
        return $queryResult;
    }

    /**
     * Return query result data.
     *
     * @return array
     */
    public function first()
    {
        $this->fix();
        $this->formatQuery();
        $queryResult = $this->database->row($this->sql);
        $this->clearSql();
        return $queryResult;
    }

    /**
     * Clear sql string.
     *
     * @return void
     */
    private function clearSql()
    {
        $this->sql = null;
    }

    /**
     * Clean sql string.
     * Execute this funcion before execution query.
     *
     * @return void
     */
    private function formatQuery()
    {
        $this->sql = str_replace('  ', ' ', $this->sql);
    }

    /**
     * Dewbugs and die application, to raw SQL informed on the top.
     *
     * @return string
     */
    public function rawSql()
    {
        $this->formatQuery();
        dd($this->sql);
    }

    /**
     * Make `insert into {$table} ({$column}) VALUES ({$values})`.
     *
     * @param array $data
     * @return array
     */
    public function create($data = [])
    {
        $this->fix();
        /**
         * NOTE This is to mapping just fillable columns.
         */
        $params = [];
        foreach($this->model->fillable as $column) {
            /**
             * NOTE If the input data ($data) dont have a column informed on $fillable, the value is null. But...
             * TODO Needs to create a method do manage `required` and `not required` columns.
             */
            if (isset($data[$column])) {
                /**
                 * TODO Create `$casts` attribute on model.
                 * TODO Read `$casts` and cast the value as equal.
                 */
                $params[$column] = (string) escape($data[$column]);
            }
        }
        /**
         * NOTE Getting only fillable columns.
         * NOTE Its possible to crash a funcion if column on database is `not null` and here value `is null`.
         */
        $mapedColumns = implode(',', array_keys($params));
        $mapedParameters = '\''.implode('\',', explode(',', implode(',\'', $params))).'\'';
        $mapedParameters = str_replace('\'null\'', 'NULL', $mapedParameters);

        $this->sql = "INSERT INTO {$this->table} ({$mapedColumns}) VALUES ({$mapedParameters});";
        $this->formatQuery();
        // $this->rawSql();
        // Execute query.
        $created = $this->database->query($this->sql);
        // Clear sql query.
        $this->clearSql();
        // Get Last id.
        $lastId = $this->database->lastInsertId();
        // Get one by last id.
        return $this->select()->where($this->pk, '=', $lastId)->first();
    }

    /**
     * Make `update {$table} set {$column} where {$index}`.
     *
     * @param string $index
     * @param array $params
     * @return array
     */
    public function update($index = 0, $params = [])
    {
        $this->fix();
        $parameters = [];
        foreach($params as $column => $value) {
            if ($value === null) {
                $parameters[] = "{$column}='null'";
            } else {
                $parameters[] = "{$column}='{$value}'";
            }
        }

        $mapedColumns = "{$this->alias}." . implode(",{$this->alias}.", $parameters);
        $mapedParameters = str_replace('\'null\'', 'NULL', $mapedColumns);

        $this->sql = "UPDATE {$this->table} AS {$this->alias} SET {$mapedColumns} ";
        $this->where($this->pk, '=', $index);
        $this->formatQuery();
        // $this->rawSql();
        $result = $this->database->query($this->sql);
        // Clear sql query.
        $this->clearSql();

        return $this->where($this->pk, '=', $index)->first();

    }

    /**
     * Make `DELTE FROM {$table} WHERE {$index}`.
     *
     * @param string $index
     * @return array
     */
    public function delete($index = 0)
    {
        $this->fix();
        $this->sql = "DELETE FROM {$this->table} WHERE {$this->pk} = {$index};";
        // $this->where($this->pk, '=', $index);
        $this->formatQuery();
        // $this->rawSql();
        $result = $this->database->query($this->sql);
        // Clear sql query.
        $this->clearSql();

        return $result;
    }

    /**
     * Make `DELTE FROM {$table} WHERE {$index}`.
     *
     * @param string $index
     * @return array
     */
    public function execute($sql = null)
    {
        $this->fix();
        $this->sql = "DELETE FROM {$this->table} WHERE {$this->pk} = {$index};";
        $this->formatQuery();
        $result = $this->database->query($this->sql);
        // Clear sql query.
        $this->clearSql();
        return $result;
    }

    private function fix()
    {
        $database = new Database;
        $this->database = $database->newInstance();
    }

}
