<?php

class SoftUni_Contest_Block_Form extends Mage_Core_Block_Template
{
    public function getActionUrl()
    {
        return $this->getUrl('softuni_contest/form/persist');
    }
}

?>