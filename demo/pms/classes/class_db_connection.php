<?php

	class db_connection{

		public $connection_status;

		public function __construct($host,$user,$pass,$db){
			if($this->connect($host,$user,$pass,$db)){
				return true;
			}else{
				return false;
			}
		}

		private function connect($host,$user,$pass,$db){
			if($this->connection_status = mysqli_connect($host,$user,$pass,$db)){
				return true;
			}else{
				return false;
			}
		}
	}


	

?>