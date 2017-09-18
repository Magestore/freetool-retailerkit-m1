<?php
class Magestore_RetailerKitTools_Helper_Data extends Mage_Core_Helper_Abstract
{

	public function getRetailerKitToolsConfig($group ,$code,  $storeId = 0){
		return Mage::getStoreConfig('retailerkittools/'.$group.'/'.$code,  $storeId);
	}
}
	 