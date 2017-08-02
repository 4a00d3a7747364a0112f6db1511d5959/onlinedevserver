<?php



class get_details{
	public $user_id;
	public $user_email;
	public $user_name;
	public $user_doj;
	public $user_role;
	public function __construct($conn_stat, $log_email){
		$this->get($conn_stat, $log_email);
	}

	public function get($conn_stat, $log_email){

		$sql = "SELECT * FROM `employes` WHERE `u_email` = '$log_email' ";
		$res = mysqli_query($conn_stat, $sql);
		$details = mysqli_fetch_assoc($res);
		$this->user_id = $details['u_id'];
		$this->user_email = $details['u_email'];
		//$this->user_name = $details['u_fullname'];
		//$this->user_doj = $details['u_doj'];
		$this->user_role = 3;
	}
}

?>