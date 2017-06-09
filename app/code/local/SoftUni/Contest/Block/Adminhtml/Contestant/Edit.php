<?php
class SoftUni_VentsyslavVassilev_Block_Adminhtml_VentsyslavVassilev_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'ID';
        $this->_blockGroup = 'softuni_ventsyslavvassilev';
        $this->_controller = 'adminhtml_ventsyslavvassilev';
        parent::__construct();
        $this->_updateButton('save', 'label', Mage::helper('softuni_ventsyslavvassilev')->__('Save Submission'));
        $this->_updateButton('delete', 'label', Mage::helper('softuni_ventsyslavvassilev')->__('Delete Submission'));
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('block_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'block_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'block_content');
                }
            }
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
}