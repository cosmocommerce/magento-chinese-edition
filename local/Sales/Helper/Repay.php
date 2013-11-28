<?php
class Mage_Sales_Helper_Repay extends Mage_Core_Helper_Data
{
    const XML_PATH_SALES_REORDER_ALLOW = 'sales/repay/allow';

    public function isAllow()
    {
        return $this->isAllowed();
    }

    /**
     * Check if reorder is allowed for given store
     *
     * @param Mage_Core_Model_Store|int|null $store
     * @return bool
     */
    public function isAllowed($store = null)
    {
        return true;
    }

    public function canRepay(Mage_Sales_Model_Order $order)
    {
        if (!$this->isAllowed($order->getStore())) {
            return false;
        }
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            return $order->canRepay();
        } else {
            return true;
        }
    }
}
