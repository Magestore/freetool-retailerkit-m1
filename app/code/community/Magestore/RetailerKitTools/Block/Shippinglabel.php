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
class Magestore_Retailerkittools_Block_Shippinglabel extends Mage_Core_Block_Template
{
    protected function _construct()
    {
        parent::_construct();
    }

    public function getSenderData(){
    	return Mage::app()->getRequest()->getParam('sender');
    }

    public function getReceiverData(){
    	return Mage::app()->getRequest()->getParam('receiver');
    }

    public function getShippingDate(){
    	return Mage::app()->getRequest()->getParam('shipping_date');
    }
    public function getTrackingNumber(){
    	return Mage::app()->getRequest()->getParam('tracking_number');
    }

    public function getWeight(){
    	return Mage::app()->getRequest()->getParam('weight');
    }

    public function getUnitOfMeasurement(){
        return Mage::app()->getRequest()->getParam('unit_measurement');
    }

     public function getBarcodeUrl()
    {        
        $result = array();
        $filename="barcode.png";
        $barcodeString = Mage::app()->getRequest()->getParam('tracking_number');
        if(!$barcodeString){
            $id = Mage::app()->getRequest()->getParam('data');
            $order = Mage::getModel('retailerkittools/label')->load($id);
            $data = json_decode($order->getLabelData());
            
            $barcodeString = $data->tracking_number;
        }
        $file = Zend_Barcode::draw('code128', 'image', array('text' => $barcodeString, 'drawText' => false), array());
        $barcode_path= DS."barcode".DS."barcode.png";

        $store_image = imagepng($file,Mage::getBaseDir('media').$barcode_path);
        $urlImage = '';
        if($store_image)
        {
            $path = Mage::getBaseDir('media') . DS . $barcode_path;
            $urlImage = Mage::getBaseUrl('media') . DS . $barcode_path;            
        }
        return $urlImage;
    }
}