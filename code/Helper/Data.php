<?php
class CosmoCommerce_ChineseLocale_Helper_Data extends Mage_Directory_Helper_Data
{
    protected $_cityJson;
    public function getCityJson()
    {
        return $this->getCityJsonByStore();
    }
    public function getCityJsonByStore($storeId = null)
    {
        Varien_Profiler::start('TEST: '.__METHOD__);
        if (!$this->_cityJson) {
            $store = $this->_app->getStore($storeId);
            $cacheKey = 'DIRECTORY_REGIONS_JSON_STORE' . (string)$store->getId();
            if ($this->_app->useCache('config')) {
                $json = $this->_app->loadCache($cacheKey);
            }
            if (empty($json)) {
                $cities = $this->_getRegions($storeId);
                $helper = $this->_factory->getHelper('core');
                $json = $helper->jsonEncode($cities);

                if ($this->_app->useCache('config')) {
                    $this->_app->saveCache($json, $cacheKey, array('config'));
                }
            }
            $this->_cityJson = $json;
        }

        Varien_Profiler::stop('TEST: ' . __METHOD__);
        return $this->_cityJson;
    }
}
