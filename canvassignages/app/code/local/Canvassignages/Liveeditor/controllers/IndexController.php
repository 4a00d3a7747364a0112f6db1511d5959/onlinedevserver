<?php

class Canvassignages_Liveeditor_IndexController extends Mage_Core_Controller_Front_Action
{
   public function indexAction()
   {
     //echo 'test index' ;
     $this->loadLayout();
          $this->renderLayout();
   }
   public function canvasprintAction()
   {
     //echo 'test mamethode';
     
     $block = $this->getLayout()->createBlock('core/template');

        // Assign your template to it
        // This path is relative to your current theme (eg: rwd/default/template/...)
        $block->setTemplate('canvassignages_liveeditor/liveeditor.phtml');

        // Render the template to the browser
        echo $block->toHtml();
     
    }
    
    
    public function saveAction()
    
    {
		//echo "here";
		
		
		echo $name = ''.$this->getRequest()->getPost('name');
		
		$block = $this->getLayout()->createBlock('core/template');

        // Assign your template to it
        // This path is relative to your current theme (eg: rwd/default/template/...)
        $block->setTemplate('canvassignages_liveeditor/liveeditor.phtml');

        // Render the template to the browser
        //echo $block->toHtml();
	}
    
    
}
 
