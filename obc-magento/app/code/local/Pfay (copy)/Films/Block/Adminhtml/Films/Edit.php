<?php

class Pfay_Films_Block_Adminhtml_Films_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{

   public function __construct()
   {
	   //echo "here";
	   //die;
        parent::__construct();
        $this->_objectId = 'id';
        //you will notice that assigns the same blockGroup the Grid Container
        $this->_blockGroup = 'pfay_films';
        // and the same container
        $this->_controller = 'adminhtml_films';
        //we define the labels for the buttons save and delete
        $this->_updateButton('save', 'label','Save movie');
        $this->_updateButton('delete', 'label', 'Delete movie');
    }

       /* Here, we look at whether it was transmitted item to form
        * to put the right text in the header (Add or Edit)
        */

    public function getHeaderText()
    {
        if( Mage::registry('films_data') && Mage::registry('films_data')->getId() )
         {
              return 'Edit a movie '.$this->htmlEscape( Mage::registry('films_data')->getTitle() );
         }
         else
         {
             return 'Add a movie';
         }
    }
}
