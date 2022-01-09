<?php

class Task {
	protected $id;
	protected $description;
	protected $tasktime;
	protected $status;

	private $table_name = "tasks";
	private $dbConn;

	function setId($id) { $this->id = $id; }
	function getId() { return $this->id; }
	function setDescription($description) { $this->description = $description; }
	function getDescription() { return $this->description; }
	function setTasktime($tasktime) { $this->tasktime = $tasktime; }
	function getTasktime() { return $this->tasktime; }
	function setStatus($status) { $this->status = $status; }
	function getStatus() { return $this->status; }

	public function __construct()
	{
		require_once ('DbConnect.php');
		$db = new DbConnect();
		$this->dbConn = $db->connect();
	}

	public function create()
	{
		$sql = "INSERT INTO $this->table_name VALUES(NULL, :description, :tasktime, :status)";
		$statement = $this->dbConn->prepare($sql);
		$statement->bindParam(':description', $this->description);
		$statement->bindParam(':tasktime', $this->tasktime);
		$statement->bindParam(':status', $this->status);
		if($statement->execute()){
			return true;
		} else {
			return false;
		}
	}

	public function getAllTask()
	{	
		$statement = $this->dbConn->prepare("SELECT * from $this->table_name");
		$statement->execute();
		$tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
		// die(var_dump($tasks));
		return $tasks;
	}

	public function update()
	{
		$statement = $this->dbConn->prepare('UPDATE ' .  $this->table_name . ' SET description = :description, tasktime = :tasktime WHERE id = :id');
		$statement->bindParam(':description', $this->description);
		$statement->bindParam(':tasktime', $this->tasktime);
		$statement->bindParam(':id', $this->id);
		if($statement->execute()){
			return true;
		} else {
			return false;
		}
			
	}

	public function delete()
	{
		$statement = $this->dbConn->prepare('DELETE from ' .  $this->table_name . ' WHERE id = :id');
		$statement->bindParam(':id', $this->id);
		if($statement->execute()){
			return true;
		} else {
			return false;
		}
			
	}

}