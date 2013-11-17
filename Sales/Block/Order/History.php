<?php
class CosmoCommerce_Sales_Block_Order_History extends Mage_Sales_Block_Order_History
{


    public function getRepayUrl($order)
    {
        return $this->getUrl('*/*/repay', array('order_id' => $order->getId()));
    }
}
