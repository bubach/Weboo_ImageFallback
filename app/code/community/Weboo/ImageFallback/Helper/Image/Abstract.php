<?php
/**
 * Public domain.
 *
 * Author: Christoffer Bubach
 * Date: 2014-08-22
 * Time: 18:32
 */

if ('true' == (string)Mage::getConfig()->getNode('modules/Ridestore_ImageCache/active')) {
    class Weboo_ImageFallback_Helper_Image_Abstract extends Ridestore_ImageCache_Helper_Image {}
} else if ('true' == (string)Mage::getConfig()->getNode('modules/Icommerce_CatalogImageFormat/active')
    && Mage::getStoreConfig('catalogimageformat/settings/rewrite')) {
    class Weboo_ImageFallback_Helper_Image_Abstract extends Icommerce_CatalogImageFormat_Helper_Image {}
} else {
    class Weboo_ImageFallback_Helper_Image_Abstract extends Mage_Catalog_Helper_Image {}
}
