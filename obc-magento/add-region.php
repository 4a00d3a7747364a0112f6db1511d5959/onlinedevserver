<?php
require_once 'app/Mage.php'; 

umask(0);  
Mage::init('default');
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
  
      

			$resource = Mage::getSingleton('core/resource');
      $writeConnection = $resource->getConnection('core_write');
		//echo $_REQUEST['show'];
		
 Mage::getSingleton('customer/session')->getId();
$customer_id=Mage::getSingleton('customer/session')->getId();

$fp = fopen("directory_country_region_name.csv", 'r'); 
$j = 0;
while(($website=fgetcsv($fp))) 
	{
	$locale[$j]=$website[0];
	$region_id[$j]=$website[1];
	
	$name[$j]=$website[2];
	$sql1= "SET FOREIGN_KEY_CHECKS = 0; ";
	$writeConnection->query($sql1);
	$sql ="INSERT INTO `magento`.`directory_country_region_name` (`locale`, `region_id`, `name`) VALUES 
	('$locale[$j]', '$region_id[$j]', '$name[$j]');";	
		$writeConnection->query($sql);
	echo "Save succesfully.";
	
	$j++;
	
	
	
	}



	
			
		
    ?>
