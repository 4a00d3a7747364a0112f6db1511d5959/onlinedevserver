<?php

class check_login{
	public $log_stat;
	public function __construct($conn_stat, $log_user, $log_pass){
		if($this->check($conn_stat, $log_user, $log_pass)){
			$this->log_stat = true;
		}else{
			$this->log_stat = false;
		}
	}
	public function check($conn_stat, $log_user, $log_pass){
		$sql = "SELECT `u_id` FROM  `employes` WHERE `u_email` = '$log_user' AND `u_password` = '$log_pass' ";		
		$result = mysqli_num_rows(mysqli_query($conn_stat, $sql));
		if($result > 0){
			return true;
		}else{
			return false;
		}

	}
}