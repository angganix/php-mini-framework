<?php

namespace App\Classes;

use App\Core\DB;

class User extends DB {

	private $table = "users";

	public function __construct()
	{
		parent::__construct();
	}

	public function find()
	{
		return $this->builder
			->select('id','username','fullname','email')
			->from($this->table)
			->fetchAllAssociative();
	}

	public function findOne($id)
	{
		return $this->builder
			->select('id','username','fullname','email')
			->from($this->table)
			->where('id = ?')
			->setParameter(0, $id)
			->fetchAssociative();
	}

	public function insert($data)
	{
		$sql = "INSERT INTO {$this->table} (username, password, fullname, email) VALUES(?,?,?,?)";
		$stmt = $this->db->prepare($sql);
		return $stmt->executeStatement($data);
	}

	public function update($data)
	{
		$sql = "UPDATE {$this->table} SET fullname=?, email=?, is_del=? WHERE id=? LIMIT 1";
		$stmt = $this->db->prepare($sql);
		return $stmt->executeStatement($data);
	}

	public function delete($id)
	{
		$sql = "DELETE FROM {$this->table} WHERE id=:id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue("id", $id);
		return $stmt->executeStatement();
	}

}