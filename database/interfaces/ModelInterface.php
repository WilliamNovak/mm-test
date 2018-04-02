<?php

namespace Database\Interfaces;
use Database\Database;

interface ModelInterface {

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

}
