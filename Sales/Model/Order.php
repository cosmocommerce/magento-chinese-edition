<?php
class CosmoCommerce_Sales_Model_Order extends Mage_Sales_Model_Order
{
    
    public function canRepay()
    {
        if($this->getPayment()->getMethod()=="alipay_payment"){
            if( $this->getState() == "new"){
                return true; 
            }else{
                return false; 
            }
        }else{
            return false; 
        }
    }
    
}
