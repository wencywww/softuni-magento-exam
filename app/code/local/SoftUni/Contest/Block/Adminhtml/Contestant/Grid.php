<?php

/**
 * Created by PhpStorm.
 * User: store
 * Date: 02.06.2017 г.
 * Time: 15:07
 */
class SoftUni_Contest_Block_Adminhtml_Contestant_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('softuniContestContestantGrid');
        $this->setDefaultSort('contestant_id');
        $this->setDefaultDir('DESC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('softuni_contest/contestant')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('contestant_id', array(
            'header'    => Mage::helper('softuni_contest')->__('Contestant ID'),
            'type'     => 'number',
            'index'     => 'contestant_id'
        ));

        $this->addColumn('contestID', array(
            'header'    => Mage::helper('softuni_contest')->__('Contest'),
            'type'     => 'text',
            'index'     => 'contest_id',
            'renderer' => 'SoftUni_Contest_Block_Adminhtml_Contestant_Grid_Renderer'
        ));

        $this->addColumn('approved', array(
            'header'    => Mage::helper('softuni_contest')->__('Is Approved'),
            'type'     => 'boolean',
            'index'     => 'approved',
            'renderer' => 'SoftUni_Contest_Block_Adminhtml_Contestant_Grid_Renderer'
        ));

        $this->addColumn('firstName', array(
            'header'    => Mage::helper('softuni_contest')->__('Name'),
            'type'     => 'text',
            'index'     => 'firstname'
        ));

        $this->addColumn('lastName', array(
            'header'    => Mage::helper('softuni_contest')->__('Family'),
            'type'     => 'text',
            'index'     => 'lastname'
        ));

        $this->addColumn('dateOfBirth', array(
            'header'    => Mage::helper('softuni_contest')->__('Birthday'),
            'type'     => 'date',
            'index'     => 'dob'
        ));

        $this->addColumn('country', array(
            'header'    => Mage::helper('softuni_contest')->__('Country'),
            'type'     => 'text',
            'index'     => 'country'
        ));

        $this->addColumn('city', array(
            'header'    => Mage::helper('softuni_contest')->__('City'),
            'type'     => 'text',
            'index'     => 'city'
        ));

        $this->addColumn('message', array(
            'header'    => Mage::helper('softuni_contest')->__('Message'),
            'type'     => 'text',
            'index'     => 'message'
        ));

        $this->addColumn('createdAt', array(
            'header'    => Mage::helper('softuni_contest')->__('Created'),
            'type'     => 'date',
            'index'     => 'created_at'
        ));

        $this->addColumn('updatedAt', array(
            'header'    => Mage::helper('softuni_contest')->__('Updated'),
            'type'     => 'datetime',
            'index'     => 'updated_at'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('contestant_id' => $row->getContestantId()));
    }

}


class SoftUni_Contest_Block_Adminhtml_Contestant_Grid_Renderer extends
    Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row) {

        $colIndex = $this->getColumn()->getIndex();
        $value = $row->getData($this->getColumn()->getIndex());

        //var_dump($colIndex);

        if ($colIndex == 'contest_id'){
            $contestName = Mage::getModel('softuni_contest/contest')->load($value)->getTitle();
            return '<span style="color: #0077ff;">' .$contestName.'</span>';
        }elseif($colIndex == 'approved'){
            $approvalStatus = $value == 1 ? Mage::helper('softuni_contest')->__('Yes'):Mage::helper('softuni_contest')->__('No');
            $color = ($value == 1)?("#0077ff"):("#ff0000");
            return "<span style=\"color: ".$color." \">" .$approvalStatus."</span>";

        }

    }
}