<?php
//~ class Pfay_Films_Block_Monblock extends Mage_Core_Block_Template
//~ {
     //~ public function methodblock()
     //~ {
         //~ return 'i am done' ;
     //~ }
//~ }
class Pfay_Films_Block_Monblock extends Mage_Core_Block_Template
{
     public function methodblock()
     {
        //on initialize la variable
        $retour='';

        /* we made a request: pick up all the elements of the pfay_films table (thanks to our model pfay_films/film and sort by id_pfay_films */

        $collection = Mage::getModel('pfay_films/film')->getCollection()->setOrder('id_pfay_films','asc');
        
       // print_r($collection);

         /* then browse the result of the request and with the getData() function is stored in the variable return (for display in the template) the necessary data */

        foreach($collection as $data)
        {
			//print_r($data->getData('name'));
             $retour .= $data->getData('name').'<br />';
             

         }

         /* I return a success message to the user (just so you know how to use the function) */

         Mage::getSingleton('adminhtml/session')->addSuccess('Cool Ca marche !!');
         
         

         return $retour;
      }
 }
