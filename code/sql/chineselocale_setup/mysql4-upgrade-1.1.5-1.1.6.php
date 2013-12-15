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
$installer->endSetup();