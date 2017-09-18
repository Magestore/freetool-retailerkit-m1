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

/**
 * Retailerkittools Vendor Edit Tabs Block
 * 
 * @category    Magestore
 * @package     Magestore_Retailerkittools
 * @author      Magestore Developer
 */
class Magestore_Retailerkittools_Block_Adminhtml_Vendor_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Magestore_Retailerkittools_Block_Adminhtml_Earning_Edit_Tabs constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('retailerkittools_vendor_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('retailerkittools')->__('Vendor Information'));
    }
    
    /**
     * prepare before render block to html
     *
     * @return Magestore_Retailerkittools_Block_Adminhtml_Vendor_Edit_Tabs
     */
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('retailerkittools')->__('Vendor Information'),
            'title'     => Mage::helper('retailerkittools')->__('Vendor Information'),
            'content'   => $this->getLayout()
                                ->createBlock('retailerkittools/adminhtml_vendor_edit_tab_form')
                                ->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
}
