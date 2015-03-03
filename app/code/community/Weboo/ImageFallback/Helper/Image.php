<?php
/**
 * Public domain.
 * 
 * Author: Christoffer Bubach
 * Date: 2014-08-22
 * Time: 18:32
 */
class Weboo_ImageFallback_Helper_Image extends Weboo_ImageFallback_Helper_Image_Abstract {

    public function init(Mage_Catalog_Model_Product $product, $attributeName, $imageFile=null)
    {
        $this->_reset();
        if ('true' == (string)Mage::getConfig()->getNode('modules/Icommerce_CatalogImageFormat/active')
            && Mage::getStoreConfig('catalogimageformat/settings/rewrite'))
        {
            $this->_setModel(Mage::getModel('catalogimageformat/product_image'));
        } else {
            $this->_setModel(Mage::getModel('imagecache/product_image'));
        }
        $this->_getModel()->setDestinationSubdir($attributeName);
        $this->setProduct($product);

        $this->setWatermark(Mage::getStoreConfig("design/watermark/{$this->_getModel()->getDestinationSubdir()}_image"));
        $this->setWatermarkImageOpacity(Mage::getStoreConfig("design/watermark/{$this->_getModel()->getDestinationSubdir()}_imageOpacity"));
        $this->setWatermarkPosition(Mage::getStoreConfig("design/watermark/{$this->_getModel()->getDestinationSubdir()}_position"));
        $this->setWatermarkSize(Mage::getStoreConfig("design/watermark/{$this->_getModel()->getDestinationSubdir()}_size"));

        if ($imageFile) {
            $this->setImageFile($imageFile);
            $this->_getModel()->setBaseFile($imageFile);
        }
        else {
            // add for work original size
            $this->setImageFile($this->getProduct()->getData($this->_getModel()->getDestinationSubdir()));
            $this->_getModel()->setBaseFile( $this->getProduct()->getData($this->_getModel()->getDestinationSubdir()) );
        }
        if (Mage::getStoreConfig('catalogimageformat/settings/rewrite')) {
            if ($format = (int)Mage::getStoreConfig('catalogimageformat/settings/format')) {
                $this->setOutputType($format);
            }
        }
        return $this;
    }

    public function __toString() {
        return (string)$this->_getModel()->getBaseFile();
    }

    public function resize($width, $height = null) {
        $this->_getModel()->setWidth($width)->setHeight($height);
        $this->_getModel()->setBaseFile($this->getImageFile());
        return $this;
    }

}
