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
class Magestore_Retailerkittools_Block_Barcode extends Mage_Core_Block_Template
{
    protected function _construct()
    {
        parent::_construct();
    }

    public function getBarcodeString(){
    	return Mage::app()->getRequest()->getParam('query');
    }

    public function getBarcodeImage(){    	
        $barcodeString = Mage::app()->getRequest()->getParam('query');
        $filename="barcode.png";
        $file = Zend_Barcode::draw('code128', 'image', array('text' => $barcodeString, 'drawText' => false,'barHeight'=> 25, 'factor'=>3), array());
        $barcode_path= DS."barcode".DS."barcode.png";

        $store_image = imagepng($file,Mage::getBaseDir('media').$barcode_path);
        if($store_image)
        {
            $path = Mage::getBaseDir('media') . DS . $barcode_path;
            $urlImage = Mage::getBaseUrl('media') . DS . $barcode_path;    
        }
        return $urlImage;
    }
}