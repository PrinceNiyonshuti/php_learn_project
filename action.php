<?php

require_once('Task.php');

class Action
{
	public function __construct()
	{
		switch ($_POST['submit']) {
			case 'create':
				$task = new Task();
				$task->setDescription($_POST['description']);
				$task->setTasktime($_POST['time']);
				$task->setStatus(false);
				if($task->create()){
					header('location:index.php?insert=success');
				} else {
					header('location:index.php?insert=unsuccess');
				}
				break;
			case 'update':
				$task = new Task();
				$task->setId($_POST['taskid']);
				$task->setDescription($_POST['description']);
				$task->setTasktime($_POST['time']);
				if($task->update()){
					header('location:index.php?update=successful');
				} else {
					header('location:index.php?update=unsuccessful');
				}
				break;
			case 'delete':
				$task = new Task();
				$task->setId($_POST['taskid']);
				if($task->delete()){
					header('location:index.php?delete=successful');
				} else {
					header('location:index.php?delete=unsuccessful');
				}
				break;
			
			default:
				header('index.php');
				break;
		}
	}
}

	if(isset($_POST['submit']))
	{
		$action = new Action();
	} else {
		header('index.php');
	}