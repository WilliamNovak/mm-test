<?php

namespace Database\Connections;

use MadeiraMadeira\Application\Exceptions\DatabaseErrorException;
use MadeiraMadeira\Application\Exceptions\ConfigNotFoundException;
use MadeiraMadeira\Application\Http\StatusCode;

/**
 * PDO custom class.
 * TODO crete whay to this methods is reutilizable on another drivers, with same names, parameter and returns.
 *
 * Modified and adapdated to this project:
 * @author William Novak <williamnvk@gmail.com> on 2018-04-02
 * Source:
 * @author lincanbin <https://github.com/lincanbin/PHP-PDO-MySQL-Class/blob/master/src/PDO.class.php>
 */
class PDO
{
	/**
	 * @var object
	 */
	private $instance;
	/**
	 * @var object
	 */
	private $query;
	/**
	 * @var object
	 */
	private $isConnected = false;
	/**
	 * @var object
	 */
	private $parameters = [];
	/**
	 * @var object
	 */
	public  $rowCount = 0;
	/**
	 * @var object
	 */
	public  $columnCount = 0;
	/**
	 * @var object
	 */
	public  $querycount = 0;
	/**
	 * @var object
	 */
    private $config;

	/**
	 * PDO constructor.
	 */
	public function __construct($configParams = false)
	{
		if (!$configParams || !is_object($configParams)) {
			throw new ConfigNotFoundException('Database params is empty.', StatusCode::HTTP_INTERNAL_ERROR);
		}

		$this->config = (object) $configParams;
		$this->connect();
	}

	/**
	 * @return object
	 */
	private function connect()
	{
		try {
            $this->instance = new \PDO(
				$this->config->dns,
				$this->config->username,
				$this->config->password,
				array(
					\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
					\PDO::ATTR_EMULATE_PREPARES => false,
					\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
					\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
				)
			);
			$this->isConnected = true;
		} catch (\PDOException $e) {
			throw new DatabaseErrorException($e->getMessage(), StatusCode::HTTP_INTERNAL_ERROR);
		}
	}

	/**
	 * Closes instance.
	 *
	 * @return void
	 */
	public function closeConnection()
	{
		$this->instance = null;
	}

	/**
	 * Closes instance.
	 *
	 * @return void
	 */
	private function initialize($query, $parameters = "")
	{
		if (!$this->isConnected) {
			$this->connect();
		}

		try {

			$this->parameters = $parameters;
			$this->query = $this->instance->prepare($this->assertParams($query, $this->parameters));

			if (!empty($this->parameters)) {
				if (array_key_exists(0, $parameters)) {
					$parametersType = true;
					array_unshift($this->parameters, "");
					unset($this->parameters[0]);
				} else {
					$parametersType = false;
				}
				foreach ($this->parameters as $column => $value) {
					$this->query->bindParam($parametersType ? intval($column) : ":" . $column, $this->parameters[$column]); //It would be query after loop end(before 'query->execute()').It is wrong to use $value.
				}
			}

			$this->succes = $this->query->execute();
			$this->querycount++;

		} catch (\PDOException $e) {
			throw new DatabaseErrorException(
				$this->exceptionMessage($e->getMessage(), $this->assertParams($query))
				, StatusCode::HTTP_INTERNAL_ERROR);
		}

		$this->parameters = array();
	}

	/**
	 * Assert query parameters.
	 *
	 * @param string $query
	 * @param array $params
	 * @return string
	 */
	private function assertParams($query, $params = null)
	{
		if (!empty($params)) {
			$rawStatement = explode(" ", $query);
			foreach ($rawStatement as $value) {
				if (strtolower($value) == 'in') {
					return str_replace("(?)", "(" . implode(",", array_fill(0, count($params), "?")) . ")", $query);
				}
			}
		}
		return $query;
	}

	/**
	 * Parse and execute query.
	 *
	 * @param string $query
	 * @param array $params
	 * @param string $fetchmode Do not change this
	 * @return string
	 */
	public function query($query, $params = null, $fetchmode = \PDO::FETCH_ASSOC)
	{
		$query = trim($query);
		$rawStatement = explode(" ", $query);
		$this->initialize($query, $params);
		$statement = strtolower($rawStatement[0]);
		if ($statement === 'select' || $statement === 'show') {
			return $this->query->fetchAll($fetchmode);
		} elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
			return $this->query->rowCount();
		} else {
			return NULL;
		}
	}

	/**
	 * Get last inserted id.
	 *
	 * @return int
	 */
	public function lastInsertId()
	{
		return $this->instance->lastInsertId();
	}

	/**
	 * Return only one result.
	 *
	 * @param string $query
	 * @param array $params
	 * @param string $fetchmode Do not change this
	 * @return string
	 */
	public function row($query, $params = null, $fetchmode = \PDO::FETCH_ASSOC)
	{
		$this->initialize($query, $params);
		$resultRow = $this->query->fetch($fetchmode);
		$this->rowCount = $this->query->rowCount();
		$this->columnCount = $this->query->columnCount();
		$this->query->closeCursor();
		return $resultRow;
	}

	/**
	 * Generate string with erros of execution of this query.
	 *
	 * @param string $messafge
	 * @param string $sql
	 * @return string
	 */
	private function exceptionMessage($message, $sql = "")
	{
		if (!empty($sql)) {
			$message .= "\r\nRaw SQL : " . $sql;
		}

		return $message;
	}
}
