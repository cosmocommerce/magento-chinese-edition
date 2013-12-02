<?php
class CosmoCommerce_ChineseLocale_Model_Resource_City_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected $_regionTable;
    protected $_cityTable;
    protected function _construct()
    {
        $this->_init('chineselocale/city');

        $this->_regionTable    = $this->getTable('directory/country_region');
        $this->_cityTable = $this->getTable('chineselocale/city');

        $this->addOrder('name', Varien_Data_Collection::SORT_ORDER_ASC);
        $this->addOrder('default_name', Varien_Data_Collection::SORT_ORDER_ASC);
    }

}
