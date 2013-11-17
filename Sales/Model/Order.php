<?php
class CosmoCommerce_Sales_Model_Order extends Mage_Sales_Model_Order
{
    
    public function canRepay()
    {
        return true; 
    }
    
}
