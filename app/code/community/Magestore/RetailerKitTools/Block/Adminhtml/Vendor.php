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
 * @module     Retailerkittools
 * @author      Magestore Developer
 *
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 *
 */

class Magestore_Retailerkittools_Block_Adminhtml_Vendor extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Magestore_Affiliateplus_Block_Adminhtml_Banner constructor.
     */
    public function __construct()
  {
    $this->_controller = 'adminhtml_vendor';
    $this->_blockGroup = 'retailerkittools';
    $this->_headerText = Mage::helper('retailerkittools')->__('Vendor Manager');
    // $this->_addButtonLabel = Mage::helper('retailerkittools')->__('Add New Vendor');
    parent::__construct();
  }
}