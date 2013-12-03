<?php
class CosmoCommerce_ChineseLocale_Model_Resource_City extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Table with localized region names
     *
     * @var string
     */
    protected $_cityNameTable;

    /**
     * Define main and locale region name tables
     *
     */
    protected function _construct()
    {
        $this->_init('chineselocale/city', 'city_id');
        $this->_cityNameTable = $this->getTable('chineselocale/city');
    }

}
