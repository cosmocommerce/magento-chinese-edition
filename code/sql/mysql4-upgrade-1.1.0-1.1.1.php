<?php

$installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
$installer->startSetup();
$catalog_product           = (int)$installer->getEntityTypeId('catalog_product');
$attributeIds       = array();
$select = $installer->getConnection()->select()
    ->from(
        array('ea' => $installer->getTable('eav/attribute')),
        array('entity_type_id', 'attribute_code', 'attribute_id'))
    ->where('ea.entity_type_id IN(?)', array($catalog_product));
foreach ($installer->getConnection()->fetchAll($select) as $row) {
    $attributeIds[$row['entity_type_id']][$row['attribute_code']] = $row['attribute_id'];
}
foreach($attributeIds as $attributeid){
    foreach($attributeid as $attribute_code=>$attribute_id){
        if($attribute_code=="group_price" ){
            $attribute = Mage::getModel('eav/entity_attribute')->load($attribute_id);
            $attribute->setData('frontend_label','用户组价格')->save();
        }
        if($attribute_code=="tier_price" ){
            $attribute = Mage::getModel('eav/entity_attribute')->load($attribute_id);
            $attribute->setData('frontend_label','层级价格')->save();
        }
        if( $attribute_code=="thumbnail"){
            $attribute = Mage::getModel('eav/entity_attribute')->load($attribute_id);
            $attribute->setData('frontend_label','缩略图')->save();
        }
        if( $attribute_code=="small_image" ){
            $attribute = Mage::getModel('eav/entity_attribute')->load($attribute_id);
            $attribute->setData('frontend_label','分类页产品图')->save();
        }
        if( $attribute_code=="image"){
            $attribute = Mage::getModel('eav/entity_attribute')->load($attribute_id);
            $attribute->setData('frontend_label','产品封面图')->save();
        }
    
        if( $attribute_code=="options_container"){
            $attribute = Mage::getModel('eav/entity_attribute')->load($attribute_id);
            $attribute->setData('default_value','container1')->save();
        }
    }
}
$installer->endSetup();
$installer = new Mage_Customer_Model_Entity_Setup('core_setup');
$installer->startSetup();

$customer           = (int)$installer->getEntityTypeId('customer');
$customerAddress    = (int)$installer->getEntityTypeId('customer_address');
$attributeIds       = array();
$customerAttrIds       = array();
$select = $installer->getConnection()->select()
    ->from(
        array('ea' => $installer->getTable('eav/attribute')),
        array('entity_type_id', 'attribute_code', 'attribute_id'))
    ->where('ea.entity_type_id IN(?)', array($customer, $customerAddress));

foreach ($installer->getConnection()->fetchAll($select) as $row) {
    $attributeIds[$row['entity_type_id']][$row['attribute_code']] = $row['attribute_id'];
}
foreach($attributeIds as $attributeid){
    foreach($attributeid as $attribute_code=>$attribute_id){
        if($attribute_code=="firstname"){
            $customerAttrIds[]= $attribute_id;
        }
        if($attribute_code=="lastname"){
        
            $customerAttrIds[]= $attribute_id;
        }
    
    }
}
$customer_eav_attributeTable = $installer->getTable('customer_eav_attribute');
foreach($customerAttrIds as $_attribute_id){
    $installer->run("
        UPDATE `{$customer_eav_attributeTable}` SET
        `validate_rules`= Null
        WHERE `attribute_id`='{$_attribute_id}'
    ");
}
$installer->endSetup();
exit();