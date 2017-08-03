<?php
class Pfay_Films_Block_Adminhtml_Films_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
  {
     public function __construct()
     {
          parent::__construct();
          $this->setId('films_tabs');
          $this->setDestElementId('edit_form');
          $this->setTitle('Information sur le film');
      }

      protected function _beforeToHtml()
      {
          $this->addTab('form_section', array(
                   'label' => 'About the movie',
                   'title' => 'About the movie',
                   'content' => $this->getLayout()
                                     ->createBlock('pfay_films/adminhtml_films_edit_tab_form')
                                     ->toHtml()
        ));
        
        return parent::_beforeToHtml();
    }
}
