<?php

class SoftUni_Contest_FormController extends Mage_Core_Controller_Front_Action
{
    public function enterAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function persistAction()
    {
        $post = Mage::app()->getRequest()->getPost();

        $contestID = $post['contest_id'];
        $contestModel = Mage::getModel('softuni_contest/contest')->load($contestID);

        //var_dump((bool) $contestModel->getIsActive());die;

        if($contestModel->isEmpty() || !(bool) $contestModel->getIsActive()) //do not save if the context do not exist or not is_active
        {
            $this->_redirectReferer();
            return;
        }

        $contestantModel = Mage::getModel('softuni_contest/contestant');

        $contestantModel->setData($post);
        $contestantModel->setApproved(0); //set approved to zero
        $contestantModel->setCreatedAt(date('Y-m-d H:i:s'));  //по условие не се иска, слагаме го обаче, защото е логически вярно
        $contestantModel->setUpdatedAt(date('Y-m-d H:i:s'));  //по условие не се иска, слагаме го обаче, защото е логически вярно
        $contestantModel->save();

        $this->_redirectReferer();
    }
}