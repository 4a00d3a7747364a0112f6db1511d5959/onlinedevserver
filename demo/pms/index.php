<?php
	
	require('config/connect.php');

		// login check
		if(isset($_POST['login_submit'])){

		
		if(!empty($_POST['login_email']) && !empty($_POST['login_password'])){

			$log_email = $_POST['login_email'];
			$log_passwrd = $_POST['login_password'];

				$log_check = new check_login($connection->connection_status, $log_email, $log_passwrd);				
	
				if($log_check->log_stat){
					$_SESSION['is_loggedin'] = true;
					$_SESSION['login_user_email'] = $log_email;					
					header('location: dashboard.php');
					
				}else{
					header('location: index.php');
				}
			}
	}
	
?>

<?php  if(isset($_SESSION['is_loggedin'])){ if($_SESSION['is_loggedin']){ 

header('location: dashboard.php');

 } }else{ 

 	include('login_form.php');
 	?>




<!-- <form action="index.php" method="post">
	
	<input type="email" placeholder="Email Id" name="login_email" class="inputField">
	<input type="password" placeholder="Password" name="login_password" class="inputField">
	<input type="submit" name="login_submit" value="submit">

</form> -->

 <?php 	} ?>