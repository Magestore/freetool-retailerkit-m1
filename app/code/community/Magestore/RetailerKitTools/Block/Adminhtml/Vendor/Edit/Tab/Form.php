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
 * Retailerkittools Earning Edit Form Content Tab Block
 * 
 * @category    Magestore
 * @package     Magestore_Retailerkittools
 * @author      Magestore Developer
 */
class Magestore_Retailerkittools_Block_Adminhtml_Vendor_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    /**
     * prepare tab form's information
     *
     * @return Magestore_Retailerkittools_Block_Adminhtml_Vendor_Edit_Tab_Form
     */
    protected function _prepareForm() {
        $form = new Varien_Data_Form();


        if (Mage::getSingleton('adminhtml/session')->getFormData()) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData();
            Mage::getSingleton('adminhtml/session')->setFormData(null);
        } elseif (Mage::registry('vendor_data')) {
            $data = Mage::registry('vendor_data')->getData();
        }
        $fieldset = $form->addFieldset('retailerkittools_form', array(
            'legend' => Mage::helper('retailerkittools')->__('Vendor Information')
        ));

        $dataObj = new Varien_Object($data);

        $data = $dataObj->getData();

        $fieldset->addField('vendor_name', 'text', array(
            'name' => 'vendor_name',
            'label' => Mage::helper('retailerkittools')->__('Name'),
            'title' => Mage::helper('retailerkittools')->__('Name'),
            'required' => true
        ));

        $fieldset->addField('vendor_email', 'text', array(
            'name' => 'vendor_email',
            'label' => Mage::helper('retailerkittools')->__('Email'),
            'title' => Mage::helper('retailerkittools')->__('Email'),
            'required' => true,
            'class' => 'validate-email'
        ));

        $fieldset->addField('vendor_phone', 'text', array(
            'name' => 'vendor_phone',
            'label' => Mage::helper('retailerkittools')->__('Phone'),
            'title' => Mage::helper('retailerkittools')->__('Phone'),
            'required' => true
        ));

        $fieldset->addField('vendor_address', 'text', array(
            'name' => 'vendor_address',
            'label' => Mage::helper('retailerkittools')->__('Address'),
            'title' => Mage::helper('retailerkittools')->__('Address'),
            'required' => true
        ));

        $fieldset->addField('vendor_city', 'text', array(
            'name' => 'vendor_city',
            'label' => Mage::helper('retailerkittools')->__('City'),
            'title' => Mage::helper('retailerkittools')->__('City'),
            'required' => true
        ));

        // $fieldset->addField('vendor_country', 'text', array(
        //     'name' => 'vendor_country',
        //     'label' => Mage::helper('retailerkittools')->__('Country'),
        //     'title' => Mage::helper('retailerkittools')->__('Country'),
        //     'required' => true
        // ));

        $country = $fieldset->addField('vendor_country', 'select', array(
            'name'  => 'vendor_country',
            'label'     => Mage::helper('retailerkittools')->__('Country'),
            'values'    => Mage::getModel('adminhtml/system_config_source_country')->toOptionArray(),
            'class' => 'required-entry',
            'required' => true,
            'onchange' => 'getstate(this)',
        ));

        /** Add Ajax to the Country select box html output **/  


        $fieldset->addField('vendor_state', 'text', array(
            'name'  => 'vendor_state',
            'required' => true,
            'label' => $this->__('State'),
            'values' => '--Please Select Country--',
        ));

        $countrycode = Mage::registry('vendor_data')->getData('vendor_country');
        $statearray = array();
        $states = array();
        if($countrycode){
            $statearray = Mage::getModel('directory/region_api')->items($countrycode);

            foreach ($statearray as $_state) {
                    $states[$_state['region_id']] = array(
                        'label' => $_state['name'],
                        'value' => $_state['region_id']
                    );
                }
            $fieldset->addField('vendor_state_id', 'select', array(
                'name'  => 'vendor_state_id',
                'required' => true,
                'label' => $this->__('State'),
                'values' => $states
            ));
        }else{
            $fieldset->addField('vendor_state_id', 'select', array(
                'name'  => 'vendor_state_id',
                'required' => true,
                'label' => $this->__('State'),
                'values' => $states
            ));
        }

        $fieldset->addField('vendor_zipcode', 'text', array(
            'name' => 'vendor_zipcode',
            'label' => Mage::helper('retailerkittools')->__('Zip/Postcode'),
            'title' => Mage::helper('retailerkittools')->__('Zip/Postcode'),
            'required' => true
        ));
        // $stateid = Mage::registry('vendor_data')->getData('vendor_state_id');
        $country->setAfterElementHtml("<script type=\"text/javascript\">
            function getstate(selectElement){
                var reloadurl = '". $this->getUrl('adminhtml/retailerkittools_vendor/state') . "country/' + selectElement.value;
                new Ajax.Request(reloadurl, {
                    method: 'get',
                    onComplete: function(transport){
                        var response = transport.responseText;   
                        if(response == ''){
                            $('vendor_state').up('tr').show();
                            $('vendor_state').addClassName('required-entry');                            
                            $('vendor_state_id').up('tr').hide();
                            $('vendor_state_id').removeClassName('required-entry');
                        }else{
                            $('vendor_state_id').update(response);
                            $('vendor_state').up('tr').hide();
                            $('vendor_state').removeClassName('required-entry');
                            $('vendor_state_id').up('tr').show();
                            $('vendor_state_id').addClassName('required-entry');
                            $('vendor_state').value = '';
                        }   
                    }
                });
            }
            window.onload = function(){
                var statearray = '".json_encode($statearray) ."';
                if(statearray.length > 2){
                    $('vendor_state').up('tr').hide();
                    $('vendor_state_id').up('tr').show();
                    
                }else{
                    $('vendor_state').up('tr').show();
                    $('vendor_state_id').up('tr').hide();
                }
            }
        </script>");
        // $fieldset->addField('vendor_state', 'text', array(
        //     'name' => 'vendor_state',
        //     'label' => Mage::helper('retailerkittools')->__('State'),
        //     'title' => Mage::helper('retailerkittools')->__('State'),
        //     'required' => true
        // ));

        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}
