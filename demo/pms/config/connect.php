<?php
	session_start();
	require('classes/class_db_connection.php');
	require('classes/class_check_login.php');
	require('classes/class_get_details.php');
	require('classes/class_add_details.php');

	$host = 'localhost';
	$user = 'unitetoh_pms';
	$password = 'PMs%$^&*';
	$db = 'unitetoh_pms_db';

	$connection = new db_connection($host, $user, $password, $db);

		if($connection){
			//echo "Connected to database!";
		}else{
			die('Error while connecting!');
		}

	

?>