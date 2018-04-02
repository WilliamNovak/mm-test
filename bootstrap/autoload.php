<?php

function __autoload($class_name) {
    $file = $class_name . ".php";
    file_exists($file) ?? require_once $file;
}
