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
 * Retailerkittools Earning Adminhtml Controller
 * 
 * @category    Magestore
 * @package     Magestore_Retailerkittools
 * @author      Magestore Developer
 */
class Magestore_Retailerkittools_Adminhtml_Retailerkittools_VendorController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('retailerkittools/vendor')
            ->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Vendor'),
                Mage::helper('adminhtml')->__('Vendor')
            );
        return $this;
    }
 
    /**
     * index action
     */
    public function indexAction()
    {
        $this->_title($this->__('Vendor'))
            ->_title($this->__('Vendor'));
        $this->_initAction()
            ->renderLayout();
    }
    
    public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * view and edit item action
     */
    public function editAction()
    {
        $vendorId     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('retailerkittools/vendor')->load($vendorId);

        if ($model->getId() || $vendorId == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('vendor_data', $model);

            $this->loadLayout();
            
            $this->_setActiveMenu('retailerkittools/vendor');

            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Vendor'),
                Mage::helper('adminhtml')->__('Vendor')
            );
            $this->_title($this->__('Vendor'))
                ->_title($this->__('Vendor'));
            if ($model->getId()) {
                $this->_title($this->__('Edit Vendor #%s', $model->getId()));
            } else {
                $this->_title($this->__('New Vendor'));
            }

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('retailerkittools/adminhtml_vendor_edit'))
                ->_addLeft($this->getLayout()->createBlock('retailerkittools/adminhtml_vendor_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('retailerkittools')->__('Item does not exist')
            );
            $this->_redirect('*/*/');
        }
    }
 
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * save item action
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            // zend_debug::dump($data);die;
            $model = Mage::getModel('retailerkittools/vendor');
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));
            
            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('retailerkittools')->__('Vendor was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('retailerkittools')->__('Unable to find item to save')
        );
        $this->_redirect('*/*/');
    }

     /**
     * delete item action
     */
    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('retailerkittools/vendor');
                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Vendor was successfully deleted')
                );
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function stateAction() {
        $countrycode = $this->getRequest()->getParam('country');
        $state = '';
        if ($countrycode != '') {
            $statearray = Mage::getModel('directory/region_api')->items($countrycode);
            foreach ($statearray as $_state) {
                $state .= "<option value='" . $_state['region_id'] . "'>" . $_state['name'] . "</option>";
            }
        }
        echo $state;
    } 

    public function massdeleteAction(){
        $accountIds = $this->getRequest()->getParam('vendor');
        $storeId = $this->getRequest()->getParam('store');
        if (!is_array($accountIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select vendor(s)'));
        } else {
            try {
                $stores = Mage::getModel('core/store')->getCollection()
                    ->addFieldToFilter('is_active', 1)
                    ->addFieldToFilter('store_id', array('neq' => 0));
                foreach ($accountIds as $accountId) {
                    $account = Mage::getModel('retailerkittools/vendor')->load($accountId);
                    $account->delete();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($accountIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index', array('store' => $storeId));
    }

    /**
     * @return mixed
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('retailerkittools');
    }

}
