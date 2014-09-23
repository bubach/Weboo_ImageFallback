<?php
/**
 * Public domain.
 *
 * Author: Christoffer Bubach
 * Date: 2014-08-22
 * Time: 18:44
 */

if ('true' == (string)Mage::getConfig()->getNode('modules/Ridestore_ImageCache/active')) {
    class Weboo_ImageFallback_Model_Product_Image_Abstract extends Ridestore_ImageCache_Model_Product_Image {}
} else if ('true' == (string)Mage::getConfig()->getNode('modules/Icommerce_CatalogImageFormat/active')) {
    class Weboo_ImageFallback_Model_Product_Image_Abstract extends Icommerce_CatalogImageFormat_Model_Product_Image {}
} else {
    class Weboo_ImageFallback_Model_Product_Image_Abstract extends Mage_Catalog_Model_Product_Image {}
}
