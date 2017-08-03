<?php
class Sostanza_Livehelp_Block_Adminhtml_Config_Source_Buttons
    extends Mage_Adminhtml_Block_Abstract
    implements Varien_Data_Form_Element_Renderer_Interface
{
	 protected $_livehelpID = false;
    public function getLivehelpID()
    {
        if ($this->_livehelpID === false)
            $this->_livehelpID = Mage::getStoreConfig('livehelp/widget/lhid');
        
        return $this->_livehelpID;
    }
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
		$id=$this->getLivehelpID();
		if($id!=""){
        $buttonSignUp = $this->getLayout()->createBlock('adminhtml/widget_button')->setData(array(
            'label'     => $this->__('Login as Agent'),
            'onclick'   => "window.open('http://server.livehelp.it/mobile/index2.asp?id=".$id."', '_blank');",
            'class'     => 'go',
            'type'      => 'button',
        ))
        ->toHtml();}

        $buttonDashboard  = $this->getLayout()->createBlock('adminhtml/widget_button')->setData(array(
            'label'     => $this->__('Livehelp Dashboard'),
            'onclick'   => "window.open('http://server.livehelp.it/',  '_blank');",
            'class'     => 'go',
            'type'      => 'button',
            
        ))
            ->toHtml();
        $buttonSite  = $this->getLayout()->createBlock('adminhtml/widget_button')->setData(array(
            'label'     => $this->__('Livehelp Site'),
            'onclick'   => "window.open('http://www.livehelp.it?ref=mag_console/',  '_blank');",
            'class'     => 'go',
            'type'      => 'button',
            
        ))
            ->toHtml();
        return $html . '<p>' . $buttonSignUp . '&nbsp;' . $buttonDashboard . '&nbsp;' . $buttonSite . '</p>';
		
    }
}