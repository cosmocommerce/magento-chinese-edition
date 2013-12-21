<?php
$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('chineselocale_city')};
CREATE TABLE {$this->getTable('chineselocale_city')} (
  `city_id` mediumint(8) unsigned NOT NULL auto_increment,
  `region_id` mediumint(8) unsigned NOT NULL default '0',
  `city_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`city_id`),
  KEY `FK_REGION_COUNTRY` (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Country cities';
        ");

$installer->endSetup();
