<?php

/**
 * Created by PhpStorm.
 * User: store
 * Date: 02.06.2017 г.
 * Time: 15:07
 */
class SoftUni_Contest_Block_Adminhtml_Contest_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('softuniContestContestGrid');
        $this->setDefaultSort('contest_id');
        $this->setDefaultDir('DESC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('softuni_contest/contest')->getCollection();
        $this->setCollection($collection);
        /*var_dump($this->getCollection());die();*/
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('contestID', array(
            'header'    => Mage::helper('softuni_contest')->__('Contest ID'),
            'type'     => 'number',
            'index'     => 'contest_id'
        ));


        $this->addColumn('title', array(
            'header'    => Mage::helper('softuni_contest')->__('Title'),
            'type'     => 'text',
            'index'     => 'title'
        ));


        $this->addColumn('approved', array(
            'header'    => Mage::helper('softuni_contest')->__('Is Active'),
            'type'     => 'boolean',
            'index'     => 'is_active'
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
        return $this->getUrl('*/*/edit', array('contest_id' => $row->getContestId()));
    }

}