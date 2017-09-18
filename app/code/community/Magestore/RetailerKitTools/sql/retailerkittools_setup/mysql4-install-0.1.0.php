<?php
/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_RetailerKitTool
 * @module     RetailerKitTool
 * @author      Magestore Developer
 *
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 *
 */

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('retailerkittools_vendor')};

CREATE TABLE {$this->getTable('retailerkittools_vendor')}(
  `vendor_id` int(10) unsigned NOT NULL auto_increment,
  `vendor_name` varchar(255) NOT NULL default '',
  `vendor_email` varchar(255) NOT NULL default '',
  `vendor_phone` varchar(255) NOT NULL default '',
  `vendor_address` varchar(255) NOT NULL default '',
  `vendor_city` varchar(255) NOT NULL default '',
  `vendor_country` varchar(255) NOT NULL default '',
  `vendor_zipcode` varchar(255) NOT NULL default '',
  `vendor_state` varchar(255) NOT NULL default '',
  `vendor_state_id` int(10) NOT NULL default 0,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('retailerkittools_invoice')};

CREATE TABLE {$this->getTable('retailerkittools_invoice')}(
  `invoice_id` int(10) unsigned NOT NULL auto_increment,
  `invoice_data` text NOT NULL default '',
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('retailerkittools_order')};

CREATE TABLE {$this->getTable('retailerkittools_order')}(
  `order_id` int(10) unsigned NOT NULL auto_increment,
  `order_data` text NOT NULL default '',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('retailerkittools_label')};

CREATE TABLE {$this->getTable('retailerkittools_label')}(
  `label_id` int(10) unsigned NOT NULL auto_increment,
  `label_data` text NOT NULL default '',
  PRIMARY KEY (`label_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");




				
$installer->endSetup(); 
