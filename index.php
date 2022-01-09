<?php
  require_once('Task.php');
  $taskObj = new Task();
  $tasks = $taskObj->getAllTask();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Itenary tracker</title>
  </head>
  <body>

    <div class="container">
      <form method="post" action="action.php">
        <div class="modal-header">
          <h3>Add Task</h3>
        </div>
          <?php if(isset($_GET['insert']) && $_GET['insert']=='success') : ?>
            <div class="alert alert-success" role="alert">  
              <h5>Task inserted successful!</h5>
            </div>
          <?php elseif(isset($_GET['insert']) && $_GET['insert']=='unsuccess') : ?>
            <div class="alert alert-danger" role="alert">  
              <h5>Task not inserted successful!</h5>
            </div>
          <?php elseif(isset($_GET['update']) && $_GET['update']=='successful') : ?>
            <div class="alert alert-success" role="alert">  
              <h5>Task updated successful!</h5>
            </div>
          <?php elseif(isset($_GET['update']) && $_GET['update']=='unsuccessful') : ?>
            <div class="alert alert-danger" role="alert">  
              <h5>Task not updated successful!</h5>
            </div>
          <?php elseif(isset($_GET['delete']) && $_GET['delete']=='successful') : ?>
            <div class="alert alert-success" role="alert">  
              <h5>Task deleted successful!</h5>
            </div>
        <?php elseif(isset($_GET['delete']) && $_GET['delete']=='unsuccessful') : ?>
            <div class="alert alert-danger" role="alert">  
              <h5>Task not deleted successful!</h5>
            </div>
          <?php endif; ?>
        <div class="modal-body">
            <input type="hidden" class="form-control" id="taskid" name="taskid">
          <div class="mb-3">
            <label for="description" class="form-label">Task Description</label>
            <input type="text" class="form-control" id="description" name="description">
          </div>
          <div class="mb-3">
            <label for="time" class="form-label">Task Time</label>
            <input type="text" class="form-control" id="time" name="time">
          </div>
        </div>
          <button type="submit" name="submit" value="create" id="create" class="btn btn-primary" style=" margin-left:12px;">Save Task
          </button>
          <button name="submit" value="update" id="update" class="btn btn-success" style=" margin-left:12px; display: none;">Update Task
          </button>
          <button name="submit" value="delete" id="delete" class="btn btn-danger" style=" margin-left:12px;display: none;">Delete Task
          </button>

      </form>
    </div>

      <div class="container">
        <table class="table mt-2" style="margin-right: 24px;">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Description</th>
              <th scope="col">Time</th>
              <th scope="col">Status</th>
              <th scope="colspan=2">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach($tasks as $task) {
                $result = json_encode($task, true);
                $statuses = '';
                if($task[status] === '1'){
                  $statuses = 'completed';
                } else {
                  $statuses = 'uncompleted';
                }
                echo "
                  <tr>
                    <td>$task[id]</td>
                    <td>$task[description]</td>
                    <td>$task[tasktime]</td>
                    <td>$statuses</td>
                    <td>
                      <a href='javascript:updateTask($result)'>Update</a> &nbsp;&nbsp;&nbsp;
                      <a href='javascript:deleteTask($result)'>Delete</a>

                    </td>
                  </tr> 
                ";
              }
            ?>
          </tbody>
        </table>
      </div>
      
    </div>
    <script type="text/javascript">
      function updateTask(task){
        document.getElementById('taskid').value = task.id;
        document.getElementById('description').value = task.description;
        document.getElementById('time').value = task.tasktime;
        document.getElementById('create').style.display='none';
        document.getElementById('update').style.display='block';
        document.getElementById('delete').style.display='none';
      }
      function deleteTask(task){
        document.getElementById('taskid').value = task.id;
        document.getElementById('description').value = task.description;
        document.getElementById('time').value = task.tasktime;
        document.getElementById('create').style.display='none';
        document.getElementById('update').style.display='none';
        document.getElementById('delete').style.display='block';
      }
    </script>
  </body>
</html>