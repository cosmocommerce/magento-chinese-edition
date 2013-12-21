<?php
class CosmoCommerce_Sales_Model_Order_Config extends Mage_Sales_Model_Order_Config
{
    public function getStatuses()
    {
        $statuses = Mage::getResourceModel('sales/order_status_collection')
            ->toOptionHash();
        $_statuses=array();
        foreach($statuses as $code=>$status){
            $_statuses[$code]=Mage::helper('sales')->__($status);
        }
        return $_statuses;
    }

}
