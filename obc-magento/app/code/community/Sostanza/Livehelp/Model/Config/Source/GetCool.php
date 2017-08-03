<?php

class Sostanza_Livehelp_Model_Config_Source_GetCool
{

  protected $_livehelpID = false;

    public function getLivehelpID() {

        if($this->_livehelpID === false)

            $this->_livehelpID = Mage::getStoreConfig('livehelp/widget/lhid');

        

        return $this->_livehelpID;

    }	 
    public function getDynamic()
    {
        if ($this->_dynamic === false)
		$this->_dynamic = Mage::getStoreConfig('livehelp/advancedconfig/filter');
        return $this->_dynamic;
    }
     public function getGEN()
    {
        if ($this->_viewGEN === false)
            $this->_viewGEN = Mage::getStoreConfig('livehelp/advancedconfig/viewGEN');
        return $this->_viewGEN;
    }   
     public function getCAT()
    {
        if ($this->_viewCAT === false)
            $this->_viewCAT = Mage::getStoreConfig('livehelp/advancedconfig/viewCAT');
        return $this->_viewCAT;
    }     
     public function getPROD()
    {
        if ($this->_viewPROD === false)
            $this->_viewPROD = Mage::getStoreConfig('livehelp/advancedconfig/viewPROD');
        return $this->_viewPROD;
    } 
      public function getFUNNEL()
    {
        if ($this->_viewFUNNEL === false)
            $this->_viewFUNNEL = Mage::getStoreConfig('livehelp/advancedconfig/viewFUNNEL');
        return $this->_viewFUNNEL;
    }
	 
    public function toOptionArray()
    {
  	 if ($this->getFUNNEL()!="0" || $this->getPROD()!="0"  || $this->getGEN()!="0" || $this->getCAT()!="0"){
   	 	Mage::getConfig()->saveConfig('livehelp/advancedconfig/filter', '0');
    	}
    
$curl = curl_init();

$id=$this->getLivehelpID();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://server.livehelp.it/admin/widget_elenco_ajax.asp?idgruppo='.$id
));

$resp = curl_exec($curl);

curl_close($curl);
$resp= substr_replace($resp ,"",-1);
$resp=$resp.",0=>Choose a widget...";
$asArr = explode(',', $resp);

foreach( $asArr as $val ){
 $tmp = explode( '=>', $val );
  $finalArray[ $tmp[0] ] = $tmp[1];
}
return $finalArray;

    }
}
?>