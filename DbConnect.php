<?php

class DbConnect{
	private $host = 'localhost';
	private $dbname = 'itenary_tracker';
	private $username = 'root';
	private $password = '';

	public function connect(){
		try{
			$connect = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username,$this->password);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $connect;
		} catch(PDOException $ex){
			echo 'Database error: ' . $ex->getMessage();
		}
	}
}

// $conn = new DbConnect();
// $conn->connect();