<?php
/**
 * Public domain.
 *
 * Author: Christoffer Bubach
 * Date: 2014-08-22
 * Time: 18:47
 */

class Weboo_ImageFallback_Model_Product_Image extends Weboo_ImageFallback_Model_Product_Image_Abstract {

    public function setBaseFile($file) {
        parent::setBaseFile($file);
        if ($this->_isBaseFilePlaceholder == true) {

            $path = array('http://cdnx1.ridestore.com/media/catalog/product');
            if((!empty($this->_width)) || (!empty($this->_height))) {

                // build filename path
                $path = array(
                    'http://cdnx1.ridestore.com/media/catalog/product',
                    'cache',
                    Mage::app()->getStore()->getId(),
                    $path[] = $this->getDestinationSubdir()
                );

                $path[] = "{$this->_width}x{$this->_height}";

                // add misk params as a hash
                $miscParams = array(
                    ($this->_keepAspectRatio  ? '' : 'non') . 'proportional',
                    ($this->_keepFrame        ? '' : 'no')  . 'frame',
                    ($this->_keepTransparency ? '' : 'no')  . 'transparency',
                    ($this->_constrainOnly ? 'do' : 'not')  . 'constrainonly',
                    $this->_rgbToString($this->_backgroundColor),
                    'angle' . $this->_angle,
                    'quality' . $this->_quality
                );

                // if has watermark add watermark params to hash
                if ($this->getWatermarkFile()) {
                    $miscParams[] = $this->getWatermarkFile();
                    $miscParams[] = $this->getWatermarkImageOpacity();
                    $miscParams[] = $this->getWatermarkPosition();
                    $miscParams[] = $this->getWatermarkWidth();
                    $miscParams[] = $this->getWatermarkHeigth();
                }

                $path[] = md5(implode('_', $miscParams));
            }

            // fallback to full size image if thumb not found
            $fileSize = @getimagesize(implode('/', $path).'/'.$file);
            if (!is_array($fileSize)) {
                $path = array('http://cdnx1.ridestore.com/media/catalog/product');
            }

            // append prepared filename
            $this->_baseFile = implode('/', $path) .'/'. $file;
            $this->_newFile = implode('/', $path) .'/'. $file;
        }
    }

    public function getUrl() {
        return $this->_baseFile;
    }
}