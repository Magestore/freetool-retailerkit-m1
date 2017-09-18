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
 * @package     Magestore_Retailerkittools
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Retailerkittools Custom Link Form Block
 * 
 * @category    Magestore
 * @package     Magestore_Retailerkittools
 * @author      Magestore Developer
 */
class Magestore_Retailerkittools_Block_Vendors extends Mage_Core_Block_Template
{  

    public function __construct() {
 		parent::__construct();
 		$collection = $this->getVendorCollection();
 		$this->setCollection($collection);
 	}
 	
 	public function _prepareLayout() {
		 parent::_prepareLayout();
 		$pager = $this->getLayout()->createBlock('page/html_pager', 'retailerkittools.pager')->setCollection($this->getCollection());
 		$this->setChild('pager', $pager);
		return $this;
 	}
 
 	public function getPagerHtml() {
 		return $this->getChildHtml('pager');
 	}
 
	public function getVendorCollection() {
 		$collection = Mage::getModel('retailerkittools/vendor')->getCollection();
 		return $collection;
 	}
}