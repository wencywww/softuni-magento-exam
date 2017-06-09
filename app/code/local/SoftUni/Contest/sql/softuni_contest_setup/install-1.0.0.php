<?php

/** @var $installer Mage_Sales_Model_Entity_Setup */
$installer = $this;
$installer->startSetup();

/**
 * Create table 'softuni_magento_exam/softuni_contest_contestant'
 */
$tableContestant = $installer->getConnection()
    ->newTable($installer->getTable('softuni_contest/contestant'))
    ->addColumn('contestant_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Contestant ID')
    ->addColumn('contest_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable' => false,
    ), 'Contest ID')
    ->addColumn('approved', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array(
    ), 'If it is approved')
    ->addColumn('firstname', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
    ), 'Firstname')
    ->addColumn('lastname', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
    ), 'Lastname')
    ->addColumn('dob', Varien_Db_Ddl_Table::TYPE_DATE, null, array(
    ), 'Date of birth')
    ->addColumn('country', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
    ), 'Country of the contestant')
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
    ), 'City of the contestant')
    ->addColumn('message', Varien_Db_Ddl_Table::TYPE_TEXT, 2550, array(
    ), 'Message')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    ), 'Updated At')
    ->addColumn('fld12', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'Additional field to make them at least 12 - according to the instructions');
$installer->getConnection()->createTable($tableContestant);


/**
 * Create table 'softuni_magento_exam/softuni_contest_contest'
 */
$tableContest = $installer->getConnection()
    ->newTable($installer->getTable('softuni_contest/contest'))
    ->addColumn('contest_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Contest ID')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
    ), 'Title of the contest')
    ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array(
    ), 'If it is active')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    ), 'Updated At')
    ->addColumn('fld6', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'Additional field to make them at least 6 - according to the instructions');
$installer->getConnection()->createTable($tableContest);


$installer->endSetup();
