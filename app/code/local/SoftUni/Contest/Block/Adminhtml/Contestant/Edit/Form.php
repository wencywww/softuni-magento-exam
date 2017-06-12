<?php
class SoftUni_Contest_Block_Adminhtml_Contestant_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('softuni_contest_contestant_form');
        $this->setTitle(Mage::helper('softuni_contest')->__('Contestant Details'));
    }
    protected function _prepareForm()
    {
        $model = Mage::registry('softuni_contest_contestant');
        $form = new Varien_Data_Form(array(
            'id'     => 'edit_form',
            'action' => $this->getUrl('adminhtml/softuni_contest_contestant/save'),
            'method' => 'post'
        ));
        $form->setHtmlIdPrefix('softuni_contest_contestant_');
        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('cms')->__('General Information'),
            'class' => 'fieldset-wide'
        ));

        if ($model->getContestantId()) {
            $fieldset->addField('contestant_id', 'hidden', array(
                'name' => 'contestant_id',
            ));
        }

        $fieldset->addField('contest_id', 'select', array(
            'name'      => 'contest_id',
            'label'     => Mage::helper('softuni_contest')->__('Contest'),
            'title'     => Mage::helper('softuni_contest')->__('Contest'),
            'required'  => true,
            'options'   => $this->getContests(),
        ));

        $fieldset->addField('approved', 'checkbox', array(
            'name'      => 'approved',
            'label'     => Mage::helper('softuni_contest')->__('Is Approved'),
            'title'     => Mage::helper('softuni_contest')->__('Is Approved'),
            'checked'   => $model->getApproved() ? true: false,
            //'value'     => $model->getApproved() ? true: false,
            'required'  => false,
        ));

        $fieldset->addField('firstname', 'text', array(
            'name'      => 'firstname',
            'label'     => Mage::helper('softuni_contest')->__('Name'),
            'title'     => Mage::helper('softuni_contest')->__('Name'),
            'required'  => true,
        ));

        $fieldset->addField('lastname', 'text', array(
            'name'      => 'lastname',
            'label'     => Mage::helper('softuni_contest')->__('Family'),
            'title'     => Mage::helper('softuni_contest')->__('Family'),
            'required'  => true,
        ));

        //Zend_Date::setOptions(array('format_type' => 'php'));
        //$dateTimeFormatIso = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        $dateTimeFormatIso = Mage::app()->getLocale()->getDateFormatWithLongYear();
        //Mage::app()->getLocale()->getDateFormatWithLongYear()
        $fieldset->addField('dob', 'date', array(
            'name'      => 'dob',
            //'input'     => 'date',
            'image'    => $this->getSkinUrl('images/grid-cal.gif'),
            'format'    => $dateTimeFormatIso,
            //'format'    => 'Y-m-d',
            'time'      => false,
            'label'     => Mage::helper('softuni_contest')->__('Birthday'),
            'title'     => Mage::helper('softuni_contest')->__('Birthday'),
            'required'  => false,
        ));

        $fieldset->addField('country', 'text', array(
            'name'      => 'country',
            'label'     => Mage::helper('softuni_contest')->__('Country'),
            'title'     => Mage::helper('softuni_contest')->__('Country'),
            'required'  => false,
        ));
        $fieldset->addField('city', 'text', array(
            'name'      => 'city',
            'label'     => Mage::helper('softuni_contest')->__('City'),
            'title'     => Mage::helper('softuni_contest')->__('City'),
            'required'  => true,
        ));

        $fieldset->addField('message', 'textarea', array(
            'name'      => 'message',
            'label'     => Mage::helper('softuni_contest')->__('Message'),
            'title'     => Mage::helper('softuni_contest')->__('Message'),
            'required'  => true,
        ));

        $form->setValues($model->getData());
        //var_dump($model->getData());

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

    protected function getContests()
    {
        $model = Mage::getModel('softuni_contest/contest');
        $data =$model->getCollection()->getData();

        foreach ($data as $val)
        {
            $out[$val['contest_id']] =$val['title'];
        }

        return $out;

    }
}