<?php
require('config/connect.php');	
if(isset($_SESSION['is_loggedin'])){ 
	if($_SESSION['is_loggedin']){
		$get_role = new get_details($connection->connection_status, $_SESSION['login_user_email']);
		(int)$user_role = $get_role->user_role;
		
		if($user_role == 1){
			include('admin/header.php');
			include('admin/main.php');	
		}else if($user_role == 2){
	
		}else{			
			include('detail.php');	
		}				
	}

}else{

	header('location: index.php');
}
if(!empty($_POST) && $_POST['action'] == 'update'){
	$sql = "UPDATE `unitetoh_pms_db`.`content` SET ";
	$sql .= $_POST['proj_name'] ? " proj_name = '{$_POST['proj_name']}'," : "";
	$sql .= $_POST['time_from'] ? " time_from = '{$_POST['time_from']}'," : "";
	$sql .= $_POST['time_to'] ? " time_to = '{$_POST['time_to']}'," : "";
	$sql .= $_POST['content_details'] ? " content_details = '{$_POST['content_details']}'," : "";
	$sql = rtrim($sql,',');
	$sql .= " WHERE `content`.`content_id` = '{$_POST['content_id']}'";
	
	if(mysqli_query($connection->connection_status, $sql)){
		echo  "Updated successfully!!";
	} else {
		echo "Updation Failed!!";
	};
	
} else if(!empty($_GET) && $_GET['action'] == 'delete'){
	$sql = "DELETE FROM `unitetoh_pms_db`.`content` WHERE `content`.`content_id` = '{$_GET['id']}'";
	if(mysqli_query($connection->connection_status, $sql)){
		echo  "Deleted successfully!!";
	} else {
		echo "Deletion Failed!!";
	};
	
}