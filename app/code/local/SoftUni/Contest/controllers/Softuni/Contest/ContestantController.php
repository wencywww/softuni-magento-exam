<?php

/**
 * Created by PhpStorm.
 * User: store
 * Date: 02.06.2017 г.
 * Time: 14:12
 */
class SoftUni_Contest_Softuni_Contest_ContestantController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        //die('heres');
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Contestant'));
        $contestantID = $this->getRequest()->getParam('contestant_id');
        $model = Mage::getModel('softuni_contest/contestant');

        if ($contestantID) {
            $model->load($contestantID);
            if (!$model->getContestantId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('softuni_contest')->__('This contestant no longer exists.')
                );
                $this->_redirectReferer();
                return;
            }
        }

        $this->_title(
            $model->getContestantId() ?
                $model->getFirstname() . " " . $model->getLastname()  :
                $this->__('New Contestant')
        );
        // 3. Set entered data if was error when we do save
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        // 4. Register model to use later in blocks
        Mage::register('softuni_contest_contestant', $model);

        $this->loadLayout();
        $this->renderLayout();
    }


    public function saveAction()
    {
        // check if data sent
        if ($data = $this->getRequest()->getPost()) {
            $contestantId = $this->getRequest()->getParam('contestant_id');
            $model = Mage::getModel('softuni_contest/contestant')->load($contestantId);


            if (!$model->getContestantId() && $contestantId) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('softuni_contest')->__('This contestant no longer exists.')
                );
                $this->_redirect('*/*/index');
                return;
            }
            // init model and set data
            //var_dump($model->getData()); die;
            $model->setData($data);
            if (!$contestantId)
            {
                $model->setCreatedAt(date('Y-m-d H:i:s')); //set created at if new contestant is created
            }
            $model->setUpdatedAt(date('Y-m-d H:i:s'));
            $model->setApproved(is_null($this->getRequest()->getParam('approved')) ? 0 : 1);

            //var_dump($this->getRequest()->getParam('approved')); die();

            // try to save it
            try {
                // save the data
                $model->save();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('softuni_contest')->__('The contestant has been saved.')
                );
                // clear previously saved data from session
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('contestant_id' => $model->getContestantId()));
                    return;
                }
                // go to grid
                $this->_redirect('*/*/index');
                return;
            } catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // save data in session
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                // redirect to edit form
                $this->_redirect('*/*/edit', array('contestant_id' => $this->getRequest()->getParam('contestant_id')));
                return;
            }
        }
        $this->_redirect('*/*/index');
    }


    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($contestantId = $this->getRequest()->getParam('contestant_id')) {
            try {
                // init model and delete
                $model = Mage::getModel('softuni_contest/contestant');
                $model->load($contestantId);
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('softuni_contest')->__('The contestant has been deleted.')
                );
                // go to grid
                $this->_redirect('*/*/index');
                return;
            } catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/*/edit', array('contestant_id' => $contestantId));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('softuni_contest')->__('Unable to find a contestant to delete.')
        );
        // go to grid
        $this->_redirect('*/*/index');
    }

    protected function __isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/softuni_contest');

    }

}