<?php
class SoftUni_Contest_Block_Adminhtml_Contest_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('softuni_contest_contest_form');
        $this->setTitle(Mage::helper('softuni_contest')->__('Contest Details'));
    }
    protected function _prepareForm()
    {
        $model = Mage::registry('softuni_contest_contest');
        $form = new Varien_Data_Form(array(
            'id'     => 'edit_form',
            'action' => $this->getUrl('adminhtml/softuni_contest_contest/save'),
            'method' => 'post'
        ));
        $form->setHtmlIdPrefix('softuni_contest_contest_');
        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('cms')->__('General Information'),
            'class' => 'fieldset-wide'
        ));

        if ($model->getContestId()) {
            $fieldset->addField('contest_id', 'hidden', array(
                'name' => 'contest_id',
            ));
        }

        $fieldset->addField('is_active', 'checkbox', array(
            'name'      => 'is_active',
            'label'     => Mage::helper('softuni_contest')->__('Is Active'),
            'title'     => Mage::helper('softuni_contest')->__('Is Active'),
            'checked'   => $model->getIsActive() ? true: false,
            'required'  => false,
        ));

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('softuni_contest')->__('Title'),
            'title'     => Mage::helper('softuni_contest')->__('Title'),
            'required'  => true,
        ));

        $form->setValues($model->getData());
        //var_dump($model->getData());

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}