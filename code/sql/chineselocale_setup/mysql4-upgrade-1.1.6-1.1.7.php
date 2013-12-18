<?php
$installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
$installer->startSetup();


$eav_entity_types       = array();
$customerAttrIds       = array();
$select = $installer->getConnection()->select()
    ->from($installer->getTable('eav_entity_type'));

$typeid=0;
foreach ($installer->getConnection()->fetchAll($select) as $row) {
    $eav_entity_types[$row['entity_type_id']] = $row['entity_type_code'];
    if($row['entity_type_code']=='catalog_product'){
        $typeid=$row['entity_type_id'];
    }
}

$eav_attribute_set = $installer->getTable('eav_attribute_set'); 

$sql = "UPDATE `{$eav_attribute_set}` SET `attribute_set_name` = \"默认属性组\"  WHERE `entity_type_id`=\"$typeid\" and `attribute_set_name` = \"Default\" ;";

$installer->run($sql);

$eav_attributes=array(
            
    "color"=>"颜色",
    "cost"=>"成本",
    "country_of_manufacture"=>"产地",
    "custom_design"=>"自定义设计风格",
    "custom_design_from"=>"设计生效开始日期",
    "custom_design_to"=>"设计生效结束日期",
    "custom_layout_update"=>"布局更新代码",
    "description"=>"产品详细描述",
    "enable_googlecheckout"=>"产品支持Google Checkout",
    "gallery"=>"产品图片",
    "gift_message_available"=>"是否允许留言",
    "group_price"=>"用户组价格",
    "image"=>"主图",
    "image_label"=>"主图描述",
    "is_recurring"=>"支持循环购买",
    "links_purchased_separately"=>"链接独立购买",
    "links_title"=>"链接标题",
    "manufacturer"=>"生产厂家",
    "media_gallery"=>"媒体图片",
    "meta_description"=>"Meta描述",
    "meta_keyword"=>"Meta关键字",
    "meta_title"=>"Meta标题",
    "minimal_price"=>"Minimal Price",
    "msrp"=>"商家建议零售价",
    "msrp_display_actual_price_type"=>"实际显示价格",
    "msrp_enabled"=>"使用商家建议零售价",
    "name"=>"商品名称",
    "news_from_date"=>"新品生效日期",
    "news_to_date"=>"新品结束日期",
    "options_container"=>"选项位置",
    "page_layout"=>"页面布局",
    "price"=>"价格",
    "price_view"=>"价格视图",
    "recurring_profile"=>"循环购买方式",
    "samples_title"=>"样品标题",
    "shipment_type"=>"配送方式",
    "short_description"=>"商品简介",
    "sku"=>"SKU货号",
    "small_image"=>"分类缩略图",
    "small_image_label"=>"分类缩略图描述",
    "special_from_date"=>"特价开始日期",
    "special_price"=>"特价",
    "special_to_date"=>"特价结束日期",
    "status"=>"商品状态",
    "tax_class_id"=>"税率类型",
    "thumbnail"=>"购物车缩略图",
    "thumbnail_label"=>"购物车缩略图描述",
    "tier_price"=>"层级价格",
    "url_key"=>"URL 路径标识",
    "visibility"=>"商品显示方式",
    "weight"=>"重量"




);
$eav_attribute = $installer->getTable('eav_attribute'); 

foreach ($eav_attributes as $code => $name) {
 
    $sql = "UPDATE `{$eav_attribute}` SET `frontend_label` = \"$name\"  WHERE `entity_type_id`=\"$typeid\" and  `attribute_code` = \"$code\" ;";

    $installer->run($sql);
}



$review_statuses=array(
            
    "Approved"=>"审核通过",
    "Pending"=>"等待审核",
    "Not Approved"=>"审核不通过", 
);
$review_status = $installer->getTable('review_status'); 

foreach ($review_statuses as $code => $name) {
 
    $sql = "UPDATE `{$review_status}` SET `status_code` = \"$name\"  WHERE `status_code` = \"$code\" ;";

    $installer->run($sql);
}

        

$ratings=array(
            
    "Quality"=>"物流",
    "Value"=>"价格",
    "Price"=>"质量", 
);
$rating = $installer->getTable('rating'); 

foreach ($ratings as $code => $name) {
 
    $sql = "UPDATE `{$rating}` SET `rating_code` = \"$name\"  WHERE `rating_code` = \"$code\" ;";

    $installer->run($sql);
}














$installer->endSetup();