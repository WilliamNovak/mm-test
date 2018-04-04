<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: Authorization, Auth, token, Content-Type, Access-Control-Allow-Headers');
    header('Access-Control-Allow-Credentials: true');

    die();
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


/**
 * API REST
 *
 * @author   William Novak <williamnvk@gmail.com>
 * @package  MadeiraMadeira
 * @version  1.0.0
 * @date     2018-04-02 ~ 2018-04-03
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

/**
 * Require composer autoload.
 */
require_once __DIR__.'/vendor/autoload.php';
/**
 * Require consts file.
 */
require_once __DIR__.'/bootstrap/consts.php';

/**
 * Read .env file and add one by one.
 */
$envFile = '.env';
if (file_exists($envFile)) {
    $envContent = file_get_contents($envFile);
    $envs = explode("\n", $envContent);
    foreach($envs as $env){
        if ( $env !== '') {
            putenv($env);
        }
    }
}

# Common helpers

/**
 * Debug.
 *
 * @param mixed $data
 * @return string
 */
function dd($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * Gets the value of an environment variable.
 *
 * @param  string  $key
 * @param  mixed   $default
 * @return mixed
 */
function env($key, $default = null)
{
    $value = getenv($key);
    if ($value === false) {
        return $default;
    }
    return $value;
}

/**
 * Display enviroinment variables to check `putnev` function.
 *
 * @return string
 */
function enviroinment()
{
    phpinfo(INFO_ENVIRONMENT);
}

/**
 * Escapes HTML for output
 * @param string $html
 * @return string
 */
function escape($html)
{
	return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

require_once __DIR__.'/public/index.php';
