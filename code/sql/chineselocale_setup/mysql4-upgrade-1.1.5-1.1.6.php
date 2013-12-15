<?php
$installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
$installer->startSetup();

$customer_group = $installer->getTable('customer_group'); 

$groups=array(
'NOT LOGGED IN'=>'访客',
'General'=>'普通会员',
'Wholesale'=>'银牌会员',
'Retailer'=>'金牌会员');

foreach ($groups as $code => $name) {
    $sql = "UPDATE `{$customer_group}` SET `customer_group_code` = \"$name\"  WHERE `customer_group_code` = \"$code\" ;";
    $installer->run($sql);
}

$core_website = $installer->getTable('core_website'); 
$groups=array('base'=>'默认网站');
foreach ($groups as $code => $name) {
    $sql = "UPDATE `{$core_website}` SET `name` = \"$name\"  WHERE `code` = \"$code\" ;";
    $installer->run($sql);
}
$core_store_group = $installer->getTable('core_store_group'); 
$groups=array('Main Website Store'=>'默认网站');
foreach ($groups as $code => $name) {
    $sql = "UPDATE `{$core_store_group}` SET `name` = \"$name\"  WHERE `name` = \"$code\" ;";
    $installer->run($sql);
}
    
$core_store = $installer->getTable('core_store'); 
$groups=array('default'=>'默认商店');
foreach ($groups as $code => $name) {
    $sql = "UPDATE `{$core_store}` SET `name` = \"$name\"  WHERE `code` = \"$code\" ;";
    $installer->run($sql);
}

$installer->endSetup();