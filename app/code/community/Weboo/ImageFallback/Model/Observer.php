<?php
/**
 * Public domain.
 *
 * Author: Christoffer Bubach
 * Date: 2014-08-22
 * Time: 18:38
 */

class Weboo_ImageFallback_Model_Observer {

    const HELPER_CLASS = 'Weboo_ImageFallback_Helper_Image';

    public function setHelperRewrite(Varien_Event_Observer $observer) {

        $node = Mage::getConfig()->getNode('global/helpers/catalog/rewrite/image');
        $currentValue = $node ? (string)$node : '';

        if ($currentValue != self::HELPER_CLASS) {
            Mage::getConfig()->setNode('global/helpers/catalog/rewrite/image', self::HELPER_CLASS);
        }
    }

}
