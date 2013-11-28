<?php
class CosmoCommerce_Sales_Block_Order_Recent extends Mage_Sales_Block_Order_Recent
{

    public function getRepayUrl($order)
    {
        return $this->getUrl('sales/order/repay', array('order_id' => $order->getId()));
    }
}
