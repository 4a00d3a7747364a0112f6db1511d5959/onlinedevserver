<?php
class Pfay_Films_Block_Adminhtml_Films_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
       $form = new Varien_Data_Form();
       $this->setForm($form);
       $fieldset = $form->addFieldset('films_form',
                                       array('legend'=>'ref information'));
       $fieldset->addField('name', 'text',
                       array(
                          'label' => 'Name',
                          'class' => 'required-entry',
                          'required' => true,
                           'name' => 'name',
                    ));

     if ( Mage::registry('films_data') )
     {
        $form->setValues(Mage::registry('films_data')->getData());
      }
    
      return parent::_prepareForm();
     }
}
