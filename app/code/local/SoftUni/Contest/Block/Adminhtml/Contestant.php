<?php
/*echo 'kur'; die();*/
/**
 * Created by PhpStorm.
 * User: store
 * Date: 02.06.2017 г.
 * Time: 14:35
 */
class SoftUni_Contest_Block_Adminhtml_Contestant extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {

        $this->_blockGroup = 'softuni_contest';
        $this->_controller = 'adminhtml_contestant';
        $this->_headerText = Mage::helper('softuni_contest')->__('Contestants');
       // $this->_addButtonLabel = Mage::helper('softuni_ventsyslavvassilev')->__('Add Submission');
        parent::__construct();
    }
}