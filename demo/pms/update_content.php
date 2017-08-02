<?php 
$sql = "SELECT * FROM `content` WHERE `content_id` = '{$_GET['id']}' ";
$res = mysqli_query($connection->connection_status, $sql);
$row = mysqli_fetch_assoc($res);
?>

<form method="POST" action="history.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Project Name</label>
    <input type="text" name="proj_name" class="form-control" id="project_name" value="<?php echo $row['proj_name'];  ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Time From</label>
    <input type="text" name="time_to" class="form-control" id="time_to" value="<?php echo $row['time_to'];  ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Time to</label>
    <input type="text" name="time_from" class="form-control" id="time_from" value="<?php echo $row['time_from'];  ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
	<textarea name="content_details" class="form-control" ><?php echo $row['content_details'];  ?></textarea>
  </div>
  <input type="hidden" name="action" value="update">
  <input type="hidden" name="content_id" value="<?php echo $row['content_id'];  ?>">
  <button type="submit" class="btn btn-default">Submit</button>
</form>