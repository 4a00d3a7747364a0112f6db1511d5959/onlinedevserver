<?php
require('config/connect.php');
//require('classes/class_add_details.php');

if(!empty($_POST['user_id']) && !empty($_POST['project_name'])){

$empId = $_POST['user_id'];

$projName = $_POST['project_name'];

$timeTo = $_POST['time_to'];

$timeFrom = $_POST['time_from'];

$contentDetails = $_POST['detail_description'];

$createdDate = '123456';

$log_check = new add_details($connection->connection_status, $empId, $projName, $timeTo, $timeFrom, $contentDetails, $createdDate);	

if($log_check){
	echo 'Added';
}else{
	header('location: index.php');
}

}else{
	header('location: index.php');
}