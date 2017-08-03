<?php

class Pfay_Films_Adminhtml_FilmController extends Mage_Adminhtml_Controller_Action
{
  public function indexAction()
  {
	  
          $this->loadLayout();
          
          $this->renderLayout();
          
          
          if($this->getRequest()->isPost())
          {
			  $name = $this->getRequest()->getPost('name');
			  
			  if(!is_null($name))
			  {
				  
				  $film = Mage::getModel('pfay_films/film');
					$film->setName($name);
					$film->save();

			  }
			  
		  }
          
          
          
  }
}
