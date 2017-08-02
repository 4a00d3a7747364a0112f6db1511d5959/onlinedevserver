<?php

	require('config/connect.php');

	$empId = $_POST['user_id'];

	$U_content_id = $_POST['U_content_id'];

	$projName = $_POST['project_name'];

	$timeTo = $_POST['time_to'];

	$timeFrom = $_POST['time_from'];

	$contentDetails = $_POST['detail_description'];

	$sql = "UPDATE `content` SET `proj_name`='$projName',`time_to`='$timeTo',`time_from`='$timeFrom',`content_details`='$contentDetails' WHERE `content_id`='$U_content_id' AND `emp_id`='$empId'";

	if(mysqli_query($connection->connection_status, $sql)){
		echo 'Updated';
	}
