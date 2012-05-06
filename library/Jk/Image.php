<?php

class Jk_Image
{
    private static $_imageQuality = 95;

    public function createImageFromFile($file) {
        $data = getimagesize($file);
        
        switch ($data['mime']) {
            case 'image/jpeg':
               $image = imagecreatefromjpeg($file); //jpeg file
               break;
            case 'image/gif':
                $image = imagecreatefromgif($file); //gif file
                break;
            case 'image/png':
                $image = imagecreatefrompng($file); //png file
                break;
            default: 
                $image = false;
                break;
            }
            
        return $image;
    }
    
    public function resizeImage($source, $newWidth = 100, $destination = null) {

        $image = self::createImageFromFile($source);
        
        $width = imagesx($image);
        $height = imagesy($image);
        
        // calculate thumbnail size
        $newHeight = floor($height * ($newWidth / $width));

        // create a new temporary image
        $tmpImage = imagecreatetruecolor($newWidth, $newHeight);

        // copy and resize old image into new image 
        // imagecopyresized($tmpImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagecopyresampled($tmpImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        
        if ($destination) {
            self::saveImage($tmpImage, $destination);
            return true;
        }
        
        return $tmpImage;
    }
    
    /**
     * Save image to a file
     */
    public function saveImage($image, $destination, $quality = null) {
        
        if (null === $quality) {
            $quality = self::$_imageQuality;
        }

        $imageInfo = pathinfo($destination);
        
        switch ($imageInfo['extension']) {
            case 'png':
                self::savePng($image, $destination);
                break;
            
            default:
                self::saveJpeg($image, $destination, $quality);
                break;
        }
    }
    
    public function savePng($image, $destination) {
        imagepng($image, $destination);
    }

    public function saveJpeg($image, $destination, $quality) {
        imagejpeg($image, $destination, $quality);
    }

    public function setImageQuality($quality)
    {
        $this->_imageQuality = $quality;
    }
}