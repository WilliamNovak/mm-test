<?php

namespace Database\Connections;

use MadeiraMadeira\Application\Exceptions\ConfigNotFoundException;

/**
 * PDO custom class.
 *
 * @author William Novak <williamnvk@gmail.com>
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

	public function __construct($configParams = false)
	{
		if ($configParams && is_object($configParams)) {
			$this->config = (object) $configParams;
			$this->connect();
		} else {
			// TODO create custom exception.
		}
	}

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
			throw new ConfigNotFoundException($e->getMessage());
		}
	}


	public function closeconnection()
	{
		$this->instance = null;
	}


	private function initialize($query, $parameters = "")
	{
		if (!$this->isConnected) {
			$this->connect();
		}
		try {
			$this->parameters = $parameters;
			$this->query     = $this->instance->prepare($this->assertParams($query, $this->parameters));

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
		}
		catch (PDOException $e) {
			echo $this->exceptionMessage($e->getMessage(), $this->assertParams($query));
			die();
		}

		$this->parameters = array();
	}

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

	public function query($query, $params = null, $fetchmode = \PDO::FETCH_ASSOC)
	{
		$query        = trim($query);
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


	public function lastInsertId()
	{
		return $this->instance->lastInsertId();
	}


	public function column($query, $params = null)
	{
		$this->initialize($query, $params);
		$resultColumn = $this->query->fetchAll(\PDO::FETCH_COLUMN);
		$this->rowCount = $this->query->rowCount();
		$this->columnCount = $this->query->columnCount();
		$this->query->closeCursor();
		return $resultColumn;
	}


	public function row($query, $params = null, $fetchmode = \PDO::FETCH_ASSOC)
	{
		$this->initialize($query, $params);
		$resultRow = $this->query->fetch($fetchmode);
		$this->rowCount = $this->query->rowCount();
		$this->columnCount = $this->query->columnCount();
		$this->query->closeCursor();
		return $resultRow;
	}


	public function single($query, $params = null)
	{
		$this->initialize($query, $params);
		return $this->query->fetchColumn();
	}


	private function exceptionMessage($message, $sql = "")
	{
		$exception = 'Unhandled Exception. <br />';
		$exception .= $message;
		$exception .= "<br /> You can find the error back in the log.";

		if (!empty($sql)) {
			$message .= "\r\nRaw SQL : " . $sql;
		}

		header("HTTP/1.1 500 Internal Server Error");
		header("Status: 500 Internal Server Error");
		return $exception;
	}
}
