<?php
class CosmoCommerce_ChineseLocale_IndexController extends Mage_Core_Controller_Front_Action
{
    public function taxAction(){
    
        $installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
        $installer->startSetup();
        $taxs=array(
                    
            "Taxable Goods"=>"商品税费",
            "Retail Customer"=>"销售税费",
            "Shipping"=>"运费税费", 
        );
        $tax_class = $installer->getTable('tax_class'); 

        foreach ($taxs as $code => $name) {
         
            $sql = "UPDATE `{$tax_class}` SET `class_name` = \"$name\"  WHERE `class_name` = \"$code\" ;";

            $installer->run($sql);
            echo $sql;
        }
        
    
    }
    public function customerAction(){
    
        $installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
        $installer->startSetup();


        $eav_entity_types       = array();
        $customerAttrIds       = array();
        $select = $installer->getConnection()->select()
            ->from($installer->getTable('eav_entity_type'));

        $typeid=0;
        $attribute_id=0;
        foreach ($installer->getConnection()->fetchAll($select) as $row) {
            $eav_entity_types[$row['entity_type_id']] = $row['entity_type_code'];
            if($row['entity_type_code']=='customer'){
                $typeid=$row['entity_type_id'];
                break;
            }
        }
        $select = $installer->getConnection()->select()
            ->from(array('ea' => $installer->getTable('eav_attribute')))
            ->where('ea.entity_type_id = ?', array($typeid));
        
        foreach ($installer->getConnection()->fetchAll($select) as $row) {
            
            if($row['attribute_code']=='gender'){
                $attribute_id=$row['attribute_id'];
                break;
            }
        }
        
        $genders=array(
                    
            "Male"=>"男",
            "Female"=>"女"
        );
        if($attribute_id){
            
            $select = $installer->getConnection()->select()
                ->from(array('ea' => $installer->getTable('eav_attribute_option')))
                ->where('ea.attribute_id = ?', array($attribute_id));
            
            foreach ($installer->getConnection()->fetchAll($select) as $row) {
                $eav_attribute_option_value=    $installer->getTable('eav_attribute_option_value');
                $options = $installer->getConnection()->select()
                    ->from(array('ea' => $eav_attribute_option_value))
                    ->where('ea.option_id = ?', array($row['option_id']));
                            
                foreach ($installer->getConnection()->fetchAll($options) as $_row) {
                                
                    foreach ($genders as $code => $name) {
                        $value_id=$_row['value_id'];
                        $sql = "UPDATE `{$eav_attribute_option_value}` SET `value` = \"$name\"  WHERE `value_id`=\"$value_id\" and `value` = \"$code\" ;";

                        $installer->run($sql);
                        echo $sql;
                    }
                    
                    //$sql = "UPDATE `{$review_status}` SET `status_code` = \"$name\"  WHERE `status_code` = \"$code\" ;";

                    //$installer->run($sql);
                    echo $_row['value_id'];
                }
                
            }
        }
        
        exit();
    
    }
    public function reviewAction(){
        $installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
        $installer->startSetup();
        $review_statuses=array(
                    
            "Approved"=>"审核通过",
            "Pending"=>"等待审核",
            "Not Approved"=>"审核不通过", 
        );
        $review_status = $installer->getTable('review_status'); 

        foreach ($review_statuses as $code => $name) {
         
            $sql = "UPDATE `{$review_status}` SET `status_code` = \"$name\"  WHERE `status_code` = \"$code\" ;";

            $installer->run($sql);
            echo $sql;
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
            echo $sql;
        }
        echo 'done';
    }
    public function eavAction(){
    
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
            echo $sql;
        }
        
        
        echo 'done';
        exit();
        
    }
    public function installAction(){
    
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
        echo 'done';


        $installer->endSetup();
    }
    public function indexAction()
    {
        
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
            TRUNCATE table `{$directory_country_region}`;
        ");
        $installer->run("
            TRUNCATE table `{$directory_country_region_name}`;
        ");
        
        $regions=array(
         'BJ'=>'北京',
         'SH'=>'上海',
        'GD'=>'广东',
         'JS'=>'江苏',
        'SD'=>'山东',
         'SC'=>'四川',
        'TW'=>'台湾',
         'ZJ'=>'浙江',
        'LN'=>'辽宁',
         'HN1'=>'河南',
        'HB'=>'湖北',
         'FJ'=>'福建',
        'HB1'=>'河北',
         'HN'=>'湖南',
        'HK'=>'香港',
         'HLJ'=>'黑龙江',
        'TJ'=>'天津',
         'CQ'=>'重庆',
        'JX'=>'江西',
         'SX1'=>'山西',
        'AH'=>'安徽',
         'SX'=>'陕西',
        'HN2'=>'海南',
         'YN'=>'云南',
        'GS'=>'甘肃',
         'NMG'=>'内蒙古',
        'GZ'=>'贵州',
         'XJ'=>'新疆',
        'XZ'=>'西藏',
         'QH'=>'青海',
        'GX'=>'广西',
         'AM'=>'澳门',
        'NX'=>'宁夏',
        'JL'=>'吉林' 
        );
        $country_code = 'CN';
        $locale = 'zh_CN';
        
  
        foreach ($regions as $region_code => $region_name) {
         
            // insert region 
            $sql = "INSERT INTO `{$directory_country_region}` (`region_id`,`country_id`,`code`,`default_name`) VALUES (NULL,'{$country_code}','{$region_code}','{$region_name}')";
            $installer->run($sql);
         
            // get new region id for next query
            $region_id = $installer->getConnection()->lastInsertId();
            // insert region name
            $sql = "INSERT INTO `{$directory_country_region_name}` (`locale`,`region_id`,`name`) VALUES ('{$locale}','{$region_id}','{$region_name}')";
            $installer->run($sql);
        }
        
        

            
            
        $installer->endSetup();
        echo 'end';
    }

}
