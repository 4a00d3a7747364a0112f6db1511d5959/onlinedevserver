<?php
class Pfay_Films_Model_Film extends Mage_Core_Model_Abstract
{
     public function _construct()
     {
         parent::_construct();
         $this->_init('pfay_films/film');
     }
}

