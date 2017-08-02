<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){

		$image = $_POST['image'];

		require_once('dbConnect.php');

		$sql = "INSERT INTO android_tab (image) VALUES (?)";

		$stmt = mysqli_prepare($con,$sql);

		mysqli_stmt_bind_param($stmt,"s",$image);
		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		if($check == 1){
			echo "Image Uploaded Successfully";
		}else{
			echo "Error Uploading Image";
		}
		mysqli_close($con);
}
if($_SERVER['REQUEST_METHOD']=='GET'){
 $id = $_GET['id'];
 $sql = "select * from android_tab where id = '$id'";
 require_once('dbConnect.php');

 $r = mysqli_query($con,$sql);

 $result = mysqli_fetch_array($r);
 
 //header('content-type: image/jpeg');
 echo json_encode($result['image']);
 //echo base64_decode($result['image']);

 mysqli_close($con);

 }
