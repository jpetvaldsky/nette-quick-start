<?php
namespace Model;

use Nette\Utils\Strings;

class Service {

	private $connection;

	public function __construct($db)
 	{
		$this->connection = $db;
	}

}
