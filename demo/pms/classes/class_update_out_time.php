<?php

class update_out_time{
	public function __construct($conn_stat, $uid, $day, $month, $year, $out_time){
		if($this->update($conn_stat, $uid, $day, $month, $year, $out_time)){
			return true;
		}else{
			return false;
		}
	}

	private function update($conn_stat, $uid, $day, $month, $year, $out_time){
		$sql = "UPDATE `Log_details` SET `out_time`='$out_time' WHERE `emp_id`='$uid' AND `l_day` = '$day' AND `l_month`='$month' AND `l_year`='$year'";
		$res = mysqli_query($conn_stat, $sql);
		if($res){
			return true;
		}else{
			return false;
		}
	}	
}


?>