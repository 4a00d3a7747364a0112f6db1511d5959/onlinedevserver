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

$fp = fopen("directory_country_region.csv", 'r'); 
$j = 0;
while(($website=fgetcsv($fp))) 
	{
	$region_id[$j]=$website[0];
	$country_id[$j]=$website[1];
	$code[$j]=$website[2];
	$name[$j]=$website[3];
	
	$sql ="INSERT INTO `magento`.`directory_country_region` (`country_id`, `code`, `default_name`) VALUES ('$country_id[$j]', '$code[$j]', '$name[$j]');";	
		$writeConnection->query($sql);
	echo "Save succesfully.";
	
	$j++;
	
	
	
	}



	
			
		
    ?>
