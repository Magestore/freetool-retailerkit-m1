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

class Magestore_Retailerkittools_Block_Adminhtml_Vendor_Renderer_State extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
    {
        $id = $row->getVendorId();
        $vendor =  Mage::getModel('retailerkittools/vendor')->load($id);
        if($vendor->getVendorState()){
        	$state = $vendor->getVendorState();
        }else{
        	if($vendor->getVendorStateId()){
        		$vendorRegion = Mage::getModel('directory/region')->load($vendor->getVendorStateId());
				$state = $vendorRegion->getName();
        	}
        }
        return $state;
    }
}