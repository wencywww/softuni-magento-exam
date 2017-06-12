<?php

/**
 * Created by PhpStorm.
 * User: store
 * Date: 02.06.2017 г.
 * Time: 14:12
 */
class SoftUni_Contest_Softuni_Contest_ContestController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        //die('heres');
        //$test = Mage::getModel('softuni_contest/contest');
        //die(get_class($test));

        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Contest'));
        $submissionID = $this->getRequest()->getParam('contest_id');
        $model = Mage::getModel('softuni_contest/contest');

        if ($submissionID) {
            $model->load($submissionID);
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('softuni_contest')->__('This contest no longer exists.')
                );
                $this->_redirectReferer();
                return;
            }
        }

        $this->_title(
            $model->getId() ?
                $model->getName() :
                $this->__('New Contest')
        );
        // 3. Set entered data if was error when we do save
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        // 4. Register model to use later in blocks
        Mage::register('softuni_contest_contest', $model);

        $this->loadLayout();
        $this->renderLayout();
    }


    public function saveAction()
    {
        // check if data sent
        if ($data = $this->getRequest()->getPost()) {
            $contestId = $this->getRequest()->getParam('contest_id');
            $model = Mage::getModel('softuni_contest/contest')->load($contestId);
            if (!$model->getContestId() && $contestId) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('softuni_contest')->__('This contest no longer exists.')
                );
                $this->_redirect('*/*/index');
                return;
            }
            // init model and set data
            $model->setData($data);
            if (!$contestId)
            {
                $model->setCreatedAt(date('Y-m-d H:i:s')); //set created at if new contest is created
            }
            $model->setUpdatedAt(date('Y-m-d H:i:s'));
            $model->setIsActive(is_null($this->getRequest()->getParam('is_active')) ? 0 : 1);


            // try to save it
            try {
                // save the data
                $model->save();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('softuni_contest')->__('The contest has been saved.')
                );
                // clear previously saved data from session
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('contest_id' => $model->getId()));
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
                $this->_redirect('*/*/edit', array('ID' => $this->getRequest()->getParam('contest_id')));
                return;
            }
        }
        $this->_redirect('*/*/index');
    }


    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($submissionId = $this->getRequest()->getParam('contest_id')) {
            try {
                // init model and delete
                $model = Mage::getModel('softuni_contest/contest');
                $model->load($submissionId);
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('softuni_contest')->__('The contest has been deleted.')
                );
                // go to grid
                $this->_redirect('*/*/index');
                return;
            } catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/*/edit', array('ID' => $submissionId));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('softuni_contest')->__('Unable to find a contest to delete.')
        );
        // go to grid
        $this->_redirect('*/*/index');
    }

    protected function __isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/softuni_contest');

    }

}