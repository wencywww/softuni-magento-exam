<?php

/**
 * Created by PhpStorm.
 * User: store
 * Date: 26.05.2017 г.
 * Time: 15:38
 */
class SoftUni_Statistics_Helper_Data extends Mage_Core_Helper_Abstract
{

    const XML_PATH_SHOW_STATS_PAGE    = 'softuni_statistics/softuni_statistics_group/availability';


    public function statsPageAvailable()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_SHOW_STATS_PAGE);
    }
}