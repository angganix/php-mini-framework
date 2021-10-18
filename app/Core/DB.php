<?php

namespace App\Core;

class DB {

	public $db, $builder;

	public function __construct()
	{
		$host = $_ENV['DB_HOST'];
		$port = $_ENV['DB_PORT'];
		$uname = $_ENV['DB_USER'];
		$upass = $_ENV['DB_PASS'];
		$dbname = $_ENV['DB_NAME'];
		$connection_params = ["url" => "mysql://$uname:$upass@$host:$port/$dbname"];
		$this->db = \Doctrine\DBAL\DriverManager::getConnection($connection_params);
		$this->builder = $this->db->createQueryBuilder();
	}

}