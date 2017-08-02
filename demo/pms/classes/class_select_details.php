<?php

class select_details{
	public $l_id;
	public $emp_id;
	public $l_day;
	public $l_month;
	public $l_year;
	public $in_time;
	public $out_time;
	public $is_late;
	public $is_hulf;
	public $is_absent;
	public $work_hour;
	public $full_date;
	public $d_wise_day;
	public function __construct($connect_stat, $emp_id,$day,$month,$year){
		$this->select($connect_stat, $emp_id,$day,$month,$year);
	}
	private function select($connect_stat, $emp_id,$day,$month,$year){
		$sql = "SELECT * FROM `Log_details` WHERE `emp_id` = '$emp_id' AND `l_day` = '$day' AND `l_month` = '$month' AND `l_year` = '$year'";
		$res = mysqli_query($connect_stat, $sql);
		$details = mysqli_fetch_assoc($res);
		$this->l_id = $details['l_id'];
		$this->emp_id = $details['emp_id'];
		$this->l_day = $details['l_day'];
		$this->l_month = $details['l_month'];
		$this->l_year = $details['l_year'];
		$this->in_time = $details['in_time'];
		$this->out_time = $details['out_time'];
		$this->is_late = $details['is_late'];
		$this->is_hulf = $details['is_hulf'];
		$this->is_absent = $details['is_absent'];
		$this->work_hour = $details['work_hour'];
		$this->full_date = $details['full_date'];
		$this->d_wise_day = $details['date_wise_day'];
	}
}

?>