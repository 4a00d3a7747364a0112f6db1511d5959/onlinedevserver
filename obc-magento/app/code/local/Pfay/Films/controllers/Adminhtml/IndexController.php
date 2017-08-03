<?php

class Pfay_Films_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu('pfay_films/set_time')->_addBreadcrumb('Movies Manager','Movies Manager');
       return $this;
     }

      public function indexAction()
      {
         $this->_initAction();
         $this->renderLayout();
      }

      public function editAction()
      {
           $filmsId = $this->getRequest()->getParam('id');
           $filmsModel = Mage::getModel('pfay_films/film')->load($filmsId);
          
           if ($filmsModel->getId() || $filmsId == 0)
           {
             Mage::register('films_data', $filmsModel);
             $this->loadLayout();
             $this->_setActiveMenu('pfay_films/set_time');
             $this->_addBreadcrumb('films Manager', 'films Manager');
             $this->_addBreadcrumb('Films Description', 'Films Description');
             $this->getLayout()->getBlock('head')
                  ->setCanLoadExtJs(true);
             $this->_addContent($this->getLayout()
                  ->createBlock('pfay_films/adminhtml_films_edit'))
                  ->_addLeft($this->getLayout()
                  ->createBlock('pfay_films/adminhtml_films_edit_tabs')
              );
             $this->renderLayout();
           }
           else
           {
                 Mage::getSingleton('adminhtml/session')->addError('Films does not exist');
                 $this->_redirect('*/*/');
            }
       }

       public function newAction()
       {
          $this->_forward('edit');
       }

       public function saveAction()
       {
         if ($this->getRequest()->getPost())
         {
               try {
                     $postData = $this->getRequest()->getPost();
                     $filmsModel = Mage::getModel('pfay_films/film');
    
                   if( $this->getRequest()->getParam('id') <= 0 ) {
                      $filmsModel->setCreatedTime( Mage::getSingleton('core/date')->gmtDate() );
                      $filmsModel
                        ->addData($postData)
                        ->setUpdateTime( Mage::getSingleton('core/date')->gmtDate())
                        ->setId($this->getRequest()->getParam('id'))
                        ->save();
                   
                     Mage::getSingleton('adminhtml/session')->addSuccess('successfully saved');
                     Mage::getSingleton('adminhtml/session')->setfilmsData(false);
                     $this->_redirect('*/*/');
                     return;
                    }
                    
              } catch (Exception $e) {
              
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    Mage::getSingleton('adminhtml/session')->setfilmsData($this->getRequest()->getPost());
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    return;
                }
           
              $this->_redirect('*/*/');
          }
        }
        
        public function deleteAction()
        {
              if($this->getRequest()->getParam('id') > 0)
              {
                try
                {
                    $filmsModel = Mage::getModel('pfay_films/film');
                    $filmsModel->setId($this->getRequest()->getParam('id'))->delete();
                    Mage::getSingleton('adminhtml/session')->addSuccess('successfully deleted');
                    $this->_redirect('*/*/');
                 }
                 catch (Exception $e)
                  {
                        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                  }
             }
            $this->_redirect('*/*/');
       }
}
