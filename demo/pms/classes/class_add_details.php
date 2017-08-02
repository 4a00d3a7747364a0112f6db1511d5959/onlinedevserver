<?php
	
	class add_details{
		public function __construct($connection_s, $empId, $projName, $timeTo, $timeFrom, $contentDetails, $createdDate){

			if($this->add($connection_s, $empId, $projName, $timeTo, $timeFrom, $contentDetails, $createdDate)){
				return true;
			}else{
				return false;
			}
		}

		private function add($connection_s, $empId, $projName, $timeTo, $timeFrom, $contentDetails, $createdDate ){

			$sql = "INSERT INTO `content`(`content_id`, `emp_id`, `proj_name`, `time_to`, `time_from`, `content_details`) VALUES ('','$empId','$projName','$timeTo','$timeFrom','$contentDetails')";
			$result = mysqli_query($connection_s, $sql);
			if($result){
				return true;
			}else{
				return false;
			}
		}
	}


	

?>