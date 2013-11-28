<?php
class CosmoCommerce_ChineseLocale_Block_Adminhtml_Catalog_Product_Edit_Tabs extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tabs
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        
        foreach($this->_tabs as $tab){
            if($tab->title== Mage::helper('adminhtml')->__('Prices')  ){
                $this->removeTab($tab->tab_id);
            }
            if($tab->title== Mage::helper('adminhtml')->__('Design')  ){
                $this->removeTab($tab->tab_id);
            }
            if($tab->title== Mage::helper('adminhtml')->__('Recurring Profile')  ){
                $this->removeTab($tab->tab_id);
            }
            if($tab->title== Mage::helper('adminhtml')->__('Gift Options')  ){
                $this->removeTab($tab->tab_id);
            }
        }
        
        $this->removeTab('tags');
        $this->removeTab('customers_tags');
        return ;
    }
}
