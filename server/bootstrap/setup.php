<?php

/**
 *
 * @author William Novak <williamnvk@gmail.com>
 * @package MadeiraMadeira
 */

use MadeiraMadeira\Application\Http\StatusCode;
use MadeiraMadeira\Application\Exceptions\ConfigNotFoundException;

function config($name) {
    $filename = CONFIG_DIR.$name.'.php';

    try {
        if (!file_exists($filename)) {
            throw new ConfigNotFoundException(sprintf('%s not found!', $filename), StatusCode::HTTP_NOT_FOUND);
        }
    } catch (\Exception $e) {
        //  dd(__CLASS__,  $e->getMessage());
    } finally {
        $config = require_once $filename;
        $data = $config[$name];

        // Initialize validators to previne erros in config files.
        switch ($name) {
            case DATABASE_CONFIG:
                databaseConfigValidator($data);
                break;

            case APP_CONFIG:
                # code...
                break;

            default:
                # no validadors.
                break;
        }

        return $data;
    }
}

/**
 * Checks config.
 *
 * @return mixed
 */
function databaseConfigValidator($data)
{
    /**
     * Collection of available database connections on this project.
     * TODO Add more connection types.
     * @var array
     */
    $setup_database_avaiable = ['pdo'];

    try {
        $type = $data['type'];
        if ( !in_array($type, $setup_database_avaiable) ) {
            throw new \Exception( sprintf('Database type %s unavailable!', $type));
        }
    } catch (\Exception $e) {
        // dd(__CLASS__,  $e->getMessage());
    }

}
