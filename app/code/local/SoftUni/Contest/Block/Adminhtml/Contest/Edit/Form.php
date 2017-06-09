<?php
class SoftUni_VentsyslavVassilev_Block_Adminhtml_VentsyslavVassilev_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('softuni_ventsyslavvassilev_ventsyslavvassilev_form');
        $this->setTitle(Mage::helper('softuni_ventsyslavvassilev')->__('Submission Information'));
    }
    protected function _prepareForm()
    {
        $model = Mage::registry('softuni_ventsyslavvassilev_ventsyslavvassilev');
        $form = new Varien_Data_Form(array(
            'id'     => 'edit_form',
            'action' => $this->getUrl('adminhtml/softuni_ventsyslavvassilev_ventsyslavvassilev/save'),
            'method' => 'post'
        ));
        $form->setHtmlIdPrefix('softuni_ventsyslavvassilev_ventsyslavvassilev_');
        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('cms')->__('General Information'),
            'class' => 'fieldset-wide'
        ));
        if ($model->getId()) {
            $fieldset->addField('ID', 'hidden', array(
                'name' => 'ID',
            ));
        }
        $fieldset->addField('Name', 'text', array(
            'name'      => 'Name',
            'label'     => Mage::helper('softuni_ventsyslavvassilev')->__('Names'),
            'title'     => Mage::helper('softuni_ventsyslavvassilev')->__('Names'),
            'required'  => true,
        ));
        $fieldset->addField('Phone', 'text', array(
            'name'      => 'Phone',
            'label'     => Mage::helper('softuni_ventsyslavvassilev')->__('Phone'),
            'title'     => Mage::helper('softuni_ventsyslavvassilev')->__('Phone'),
            'required'  => false,
        ));
        $fieldset->addField('Age', 'text', array(
            'name'      => 'Age',
            'label'     => Mage::helper('softuni_ventsyslavvassilev')->__('Age'),
            'title'     => Mage::helper('softuni_ventsyslavvassilev')->__('Age'),
            'required'  => false,
        ));
        $fieldset->addField('Email', 'text', array(
            'name'      => 'Email',
            'label'     => Mage::helper('softuni_ventsyslavvassilev')->__('Email'),
            'title'     => Mage::helper('softuni_ventsyslavvassilev')->__('Email'),
            'required'  => true,
        ));
        $form->setValues($model->getData());
        //var_dump($model->getData());

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}