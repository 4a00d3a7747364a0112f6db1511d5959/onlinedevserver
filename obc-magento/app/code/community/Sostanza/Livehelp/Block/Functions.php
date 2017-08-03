<?php

class Sostanza_Livehelp_Block_Functions extends Mage_Core_Block_Template
{
//inizializzo tutto a false
    protected $_livehelpID = false;
    protected $_method = false;
    protected $_dynamic = false;
    protected $_viewTUTTO = false;
    protected $_viewGEN= false;
    protected $_viewCAT= false;  
    protected $_viewPROD= false; 
    protected $_viewFUNNEL= false;                 
    protected $_cart = false;
    protected $_trackorder = false;
    protected $LHinfo = false;


//controlla se il plugin è stato abilitato dall'utente	
    public function isActive()
    {
        return Mage::getStoreConfigFlag('livehelp/widget/active') && $this->getLivehelpID();
    }   
//recupera l ID Livehelp 
    public function getLivehelpID()
    {
        if ($this->_livehelpID === false)
				$this->_livehelpID = Mage::getStoreConfig('livehelp/widget/lhid');
        
        return $this->_livehelpID;
    }
//vecchia funzione che recuperava l'id del widget dinamico (forse obsoleta con ultima release)
    public function getDynamic()
    {
        if ($this->_dynamic === false)
				$this->_dynamic = Mage::getStoreConfig('livehelp/advancedconfig/filter');
        return $this->_dynamic;
    }
//recupera ID widget del menu a tendina "all"
     public function getGEN()
    {
        if ($this->_viewGEN === false)
            $this->_viewGEN = Mage::getStoreConfig('livehelp/advancedconfig/viewGEN');
        return $this->_viewGEN;
    }  
//recupera ID widget del menu a tendina "categoria"     
     public function getCAT()
    {
        if ($this->_viewCAT === false)
            $this->_viewCAT = Mage::getStoreConfig('livehelp/advancedconfig/viewCAT');
        return $this->_viewCAT;
    }    
//recupera ID widget del menu a tendina "prodotto"        
     public function getPROD()
    {
        if ($this->_viewPROD === false)
            $this->_viewPROD = Mage::getStoreConfig('livehelp/advancedconfig/viewPROD');
        return $this->_viewPROD;
    } 
//recupera ID widget del menu a tendina "funnel", quindi carrello e checkout     
      public function getFUNNEL()
    {
        if ($this->_viewFUNNEL === false)
            $this->_viewFUNNEL = Mage::getStoreConfig('livehelp/advancedconfig/viewFUNNEL');
        return $this->_viewFUNNEL;
    }
//controlla se è attivata l'opzione di visualizzazione carrello          
     public function getCart()
    {
        if ($this->_cart === false)
				$this->_cart = Mage::getStoreConfig('livehelp/advancedconfig/cart');
        return $this->_cart;
    }
//controlla se è attivata l'opzione di tracking ordini               
     public function trackOrder()
    {
        if ($this->_trackorder === false)
				$this->_trackorder = Mage::getStoreConfig('livehelp/advancedconfig/trackorder');
        return $this->_trackorder;
    } 	   
//creazione dell'iframe livehelp per il tracking ordini se trackorder() è attivato  	
	public function trackCustomerOrder(){
		$sOrderId = Mage::getSingleton('checkout/session')->getLastOrderId();
		$oOrder = Mage::getModel('sales/order')->load($sOrderId);
		$TOTorder=$oOrder->getGrandTotal();
		$TOTorder=number_format((float)$TOTorder, 2, '.', '');
		$nordine=$oOrder->getIncrementId();?>
		<script>	
			//track ordine livehelp
			totale="<?php echo $TOTorder ?>";
			LHamount=totale.replace('.','');
			LHamount=LHamount.replace(',','');
			LHorderID='<?php echo $nordine ?>';

			document.write('<iframe src="//server.livehelp.it/admin/resa_livehelp.asp?gruppo=<?php echo $this->getLivehelpID(); ?>&amount=' + LHamount + '&orderID=' + LHorderID + '" height="0" width="0" style="display:none;visibility:hidden"></iframe>');
		</script>
<?php 
	} 	
}
?>