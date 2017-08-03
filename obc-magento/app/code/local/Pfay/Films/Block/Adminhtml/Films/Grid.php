<?php
class Pfay_Films_Block_Adminhtml_Films_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
   {
       parent::__construct();
       $this->setId('filmsGrid');
       $this->setDefaultSort('id_pfay_films');
       $this->setDefaultDir('DESC');
       $this->setSaveParametersInSession(true);
   }

   protected function _prepareCollection()
   {
      $collection = Mage::getModel('pfay_films/film')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }

   protected function _prepareColumns()
   {
       $this->addColumn('id_pfay_films',
             array(
                    'header' => 'ID',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'id_pfay_films',
               ));

       $this->addColumn('name',
               array(
                    'header' => 'name',
                    'align' =>'left',
                    'index' => 'name',
              ));

         return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
         return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
