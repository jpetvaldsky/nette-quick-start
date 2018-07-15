<?php
use Dibi\Connection;

class DatabaseConnection 	{

	private $connection;

	public function __construct()
 	{
		$options = [
		    'driver'   => 'mysqli',
		    'host'     => DB_HOST,
			'username' => DB_USER,
			'password' => DB_PASS,
		    'database' => DB_NAME,
		];
		$this->connection = new Connection($options);
	}

	public function get() {
		return $this->connection;
	}
}
