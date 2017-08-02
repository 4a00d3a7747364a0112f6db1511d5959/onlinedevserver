<?php

	require('config/connect.php');

	$empId = $_POST['user_id'];

	$U_content_id = $_POST['U_content_id'];
	

	$sql = "DELETE FROM `content` WHERE `content_id`='$U_content_id' AND `emp_id`='$empId'";

	if(mysqli_query($connection->connection_status, $sql)){
		echo 'Deleted';
	}
