<?php

$errors = "";

$db = mysqli_connect("", "", "", "tmampuxe_todo"); // "server IP" then "username" then "pass" then "db"

if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		} else{
			$task = $_POST['task'];
			$sql = "INSERT INTO tasks (task) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
}

if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
	header('location: index.php');
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title> Mampuru Todo</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="container">
      <div class="heading">
    		<h2>Sh*t I gotta Do...</h2>
    	</div>
      <div class="form-group">
        <form method="post" action="index.php">
          <input name="task" type="text" placeholder="enter a todo task..." class="enterTask"/>
          <input name="submit" class="submit" type="submit" value="Add tasks" />
          <?php if (isset($errors)) { ?>
          	<p class="alert"><?php echo $errors; ?></p>
          <?php } ?>
      </div>
      <div class="tasks">
				<ul>
			    <?php
			    // load all tasks on refresh
			    $tasks = mysqli_query($db, "SELECT * FROM tasks");
			    $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			    <li class="taskId"> <?php echo $i; ?> </li>
					<li class="taskItem"> <?php echo $row['task']; ?> </li>
					<li class="delete"><a href="index.php?del_task=<?php echo $row['id'] ?>">remove</a></li>
					<li style="  display: block; margin: 4em;"> </li>
				 <?php $i++; } ?>
			  </ul>
      </div>
    </div>
  </body>
</html>
