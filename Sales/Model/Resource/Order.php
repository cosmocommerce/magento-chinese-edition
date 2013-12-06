<?php
class CosmoCommerce_Sales_Model_Resource_Order extends Mage_Sales_Model_Resource_Order
    protected function _initVirtualGridColumns()
    {
        parent::_initVirtualGridColumns();
        $adapter       = $this->getReadConnection();
        $ifnullFirst   = $adapter->getIfNullSql('{{table}}.firstname', $adapter->quote(''));
        $ifnullLast    = $adapter->getIfNullSql('{{table}}.lastname', $adapter->quote(''));
        $concatAddress = $adapter->getConcatSql(array($ifnullLast, $ifnullFirst));
        $this->addVirtualGridColumn(
                'billing_name',
                'sales/order_address',
                array('billing_address_id' => 'entity_id'),
                $concatAddress
            )
            ->addVirtualGridColumn(
                'shipping_name',
                'sales/order_address',
                 array('shipping_address_id' => 'entity_id'),
                 $concatAddress
            );

        return $this;
    }
}
?>