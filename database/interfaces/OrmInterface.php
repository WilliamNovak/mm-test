<?php

namespace Database\Interfaces;
use Database\Database;

interface OrmInterface {

    /**
     * Only public methods.
     */
    public function __construct();
    public function setModel($model);
    public function select();
    public function where($column, $operator, $value);
    public function get();
    public function first();
    public function rawSql();
    public function create($data);
    public function update($index, $params);
    public function delete();

}
