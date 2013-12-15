<?php
class CosmoCommerce_ChineseLocale_IndexController extends Mage_Core_Controller_Front_Action
{
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
