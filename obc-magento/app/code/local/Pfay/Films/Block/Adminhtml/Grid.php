<?php


class Pfay_Films_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid_Container

{
	public function __construct()
  {
	  $this->_controller = 'adminhtml_films';
	  
	  $this->_blockGroup = 'pfay_films';
	  
	  
	  $this->_headerText = 'Mange My Films';
	  
	  $this->_addButtonLabel = 'Add My Films';
    
		parent::__construct(); 
	
  }
	
}
