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
			include('main.php');	
		}				
	}
}else{
	header('location: index.php');
}

?>