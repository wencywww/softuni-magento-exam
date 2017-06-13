<?php

//echo 'here on controller'; die;

class SoftUni_Statistics_StatisticsController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {

//        if ($this->_getSession()->isLoggedIn()) {
//            $this->_redirect('*/*/');
//            return;
//        }

        if ( !Mage::getSingleton('customer/session')->isLoggedIn() ) {
            $this->getResponse()->setHeader('Login-Required', 'true');
            $this->_forward('defaultNoRoute');
        }else{
            $this->loadLayout();
            $this->renderLayout();
        }

    }
}