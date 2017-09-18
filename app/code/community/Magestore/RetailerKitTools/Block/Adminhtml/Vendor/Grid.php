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

class Magestore_Retailerkittools_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	 public function __construct()
	{
		parent::__construct();
		$this->setId('vendorGrid');
		$this->setDefaultSort('vendor_id');
		$this->setDefaultDir('DESC');
		$this->setUseAjax(true);
		$this->setSaveParametersInSession(true);
	}

    /**
     * @return mixed
     */
    protected function _prepareCollection()
	{
		$collection = Mage::getModel('retailerkittools/vendor')->getCollection();
		$storeId = $this->getRequest()->getParam('store');
		
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

    /**
     * @return mixed
     */
    protected function _prepareColumns()
  	{
      	$this->addColumn('vendor_id', array(
          	'header'    => Mage::helper('retailerkittools')->__('ID'),
          	'align'     =>'right',
          	'width'     => '50px',
          	'index'     => 'vendor_id',
      	));

      	$this->addColumn('vendor_name', array(
          	'header'    => Mage::helper('retailerkittools')->__('Name'),
          	'align'     =>'left',
          	'index'     => 'vendor_name',
      	));

	  
      	$this->addColumn('vendor_email', array(
			'header'    => Mage::helper('retailerkittools')->__('Email'),
			'index'     => 'vendor_email',
      	));

      	$this->addColumn('vendor_phone', array(
			'header'    => Mage::helper('retailerkittools')->__('Phone'),
			'index'     => 'vendor_phone',
      	));

      	$this->addColumn('vendor_address', array(
			'header'    => Mage::helper('retailerkittools')->__('Address'),
			'index'     => 'vendor_address',
      	));

      	$this->addColumn('vendor_city', array(
			'header'    => Mage::helper('retailerkittools')->__('City'),
			'index'     => 'vendor_city',
      	));

      	$this->addColumn('vendor_country', array(
			'header'    => Mage::helper('retailerkittools')->__('Country'),
			'index'     => 'vendor_country',
      'type'  => 'country'
        	));

      	$this->addColumn('vendor_zipcode', array(
			'header'    => Mage::helper('retailerkittools')->__('zipcode'),
			'index'     => 'vendor_zipcode',
      	));

      $this->addColumn('vendor_state', array(
			'header'    => Mage::helper('retailerkittools')->__('State'),
			'index'     => 'vendor_id',
      'renderer'  => 'retailerkittools/adminhtml_vendor_renderer_state'
      	));
      
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('retailerkittools')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('retailerkittools')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
      return parent::_prepareColumns();
  }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
		$storeId = $this->getRequest()->getParam('store');
        $this->setMassactionIdField('vendor_id');
        $this->getMassactionBlock()->setFormFieldName('vendor');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('retailerkittools')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('retailerkittools')->__('Are you sure?')
        ));
        return $this;
    }

    /**
     * @param $row
     * @return mixed
     */
    public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId(), 'store' => $this->getRequest()->getParam('store')));
	}

    /**
     * @return mixed
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}