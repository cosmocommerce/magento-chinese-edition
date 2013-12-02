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







$directory_country_region = $installer->getTable('directory_country_region');
$directory_country_region_name = $installer->getTable('directory_country_region_name');

    $installer->run("

INSERT INTO `{$directory_country_region}` (`region_id`, `country_id`, `code`, `default_name`) VALUES
(378, 'CN', 'BJ', '北京'),
(379, 'CN', 'SH', '上海'),
(380, 'CN', 'GD', '广东'),
(381, 'CN', 'JS', '江苏'),
(382, 'CN', 'SD', '山东'),
(383, 'CN', 'SC', '四川'),
(384, 'CN', 'TW', '台湾'),
(385, 'CN', 'ZJ', '浙江'),
(386, 'CN', 'LN', '辽宁'),
(387, 'CN', 'HN1', '河南'),
(388, 'CN', 'HB', '湖北'),
(389, 'CN', 'FJ', '福建'),
(390, 'CN', 'HB1', '河北'),
(391, 'CN', 'HN', '湖南'),
(392, 'CN', 'HK', '香港'),
(393, 'CN', 'HLJ', '黑龙江'),
(394, 'CN', 'TJ', '天津'),
(395, 'CN', 'CQ', '重庆'),
(396, 'CN', 'JX', '江西'),
(397, 'CN', 'SX1', '山西'),
(398, 'CN', 'AH', '安徽'),
(399, 'CN', 'SX', '陕西'),
(400, 'CN', 'HN2', '海南'),
(401, 'CN', 'YN', '云南'),
(402, 'CN', 'GS', '甘肃'),
(403, 'CN', 'NMG', '内蒙古'),
(404, 'CN', 'GZ', '贵州'),
(405, 'CN', 'XJ', '新疆'),
(406, 'CN', 'XZ', '西藏'),
(407, 'CN', 'QH', '青海'),
(408, 'CN', 'GX', '广西'),
(409, 'CN', 'AM', '澳门'),
(410, 'CN', 'NX', '宁夏'),
(411, 'CN', 'JL', '吉林');



INSERT INTO `{$directory_country_region_name}`  (`region_id`, `locale`, `name`) VALUES
(378, 'zh_CN', '北京'),
(379, 'zh_CN', '上海'),
(380, 'zh_CN', '广东'),
(381, 'zh_CN', '江苏'),
(382, 'zh_CN', '山东'),
(383, 'zh_CN', '四川'),
(384, 'zh_CN', '台湾'),
(385, 'zh_CN', '浙江'),
(386, 'zh_CN', '辽宁'),
(387, 'zh_CN', '河南'),
(388, 'zh_CN', '湖北'),
(389, 'zh_CN', '福建'),
(390, 'zh_CN', '河北'),
(391, 'zh_CN', '湖南'),
(392, 'zh_CN', '香港'),
(393, 'zh_CN', '黑龙江'),
(394, 'zh_CN', '天津'),
(395, 'zh_CN', '重庆'),
(396, 'zh_CN', '江西'),
(397, 'zh_CN', '山西'),
(398, 'zh_CN', '安徽'),
(399, 'zh_CN', '陕西'),
(400, 'zh_CN', '海南'),
(401, 'zh_CN', '云南'),
(402, 'zh_CN', '甘肃'),
(403, 'zh_CN', '内蒙古'),
(404, 'zh_CN', '贵州'),
(405, 'zh_CN', '新疆'),
(406, 'zh_CN', '西藏'),
(407, 'zh_CN', '青海'),
(408, 'zh_CN', '广西'),
(409, 'zh_CN', '澳门'),
(410, 'zh_CN', '宁夏'),
(411, 'zh_CN', '吉林');
    ");












$installer->endSetup();