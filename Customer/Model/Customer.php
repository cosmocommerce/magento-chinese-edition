<?php
class CosmoCommerce_Customer_Model_Customer extends Mage_Customer_Model_Customer
{
    public function getName()
    {
        $name = '';
        $config = Mage::getSingleton('eav/config');
        if ($config->getAttribute('customer', 'prefix')->getIsVisible() && $this->getPrefix()) {
            $name .= $this->getPrefix() . ' ';
        }
        $name .=  $this->getLastname();
        if ($config->getAttribute('customer', 'middlename')->getIsVisible() && $this->getMiddlename()) {
            $name .= ' ' . $this->getMiddlename();
        }
        $name .= '' . $this->getFirstname();
        if ($config->getAttribute('customer', 'suffix')->getIsVisible() && $this->getSuffix()) {
            $name .= ' ' . $this->getSuffix();
        }
        return $name;
    }
}
