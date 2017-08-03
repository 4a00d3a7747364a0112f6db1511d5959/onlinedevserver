<?php
class Pfay_Films_IndexController extends Mage_Core_Controller_Front_Action
{
   public function indexAction()
   {
     //echo 'test index' ;
     $this->loadLayout();
          $this->renderLayout();
   }
   public function mamethodeAction()
   {
     echo 'test mamethode';
    }
    public function saveAction()
 {
    //we get the datas sent with POST
    $name = ''.$this->getRequest()->getPost('name');
   

    //we check that the name is not empty
    if( isset($name) && ($name!='') )
    {
		
		//echo $name;
		//die;
		
      //we create an entry in the database
      $contact = Mage::getModel('pfay_films/film');
      $contact->setData('name',$name);
      $contact->save();

     //we create an entry in the database
     // but this time we will use setName ( the method exist automatically in magento for every attribute with their name setXXX where XXX is the name of your attribute).
      $contact = Mage::getModel('pfay_films/film');
      //$contact->setName('Gladiator 3');
      //$contact->save();
    }

   //we redirect the user to the index method of the indexController
   // of our module films
   $this->_redirect('films/index/index');
}
}
