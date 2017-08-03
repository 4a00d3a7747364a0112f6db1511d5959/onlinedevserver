<?php
class Pfay_Films_Model_Resource_Film_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
 {
     public function _construct()
     {
         parent::_construct();
         $this->_init('pfay_films/film');
     }
}
