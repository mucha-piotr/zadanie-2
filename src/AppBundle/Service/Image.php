<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 18.09.2017
 * Time: 12:55
 */

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image
{
    public function flipImage($imageUrl)
    {
        $image = new \Gmagick();

        $image->read($imageUrl);
        $image->flopimage();
        $image->write($imageUrl);
        $image->destroy();
    }

    public function getWidth($imageUrl)
    {
        $info = getimagesize($imageUrl);

        return $info[0];
    }

    public function getHeight($imageUrl)
    {
        $info = getimagesize($imageUrl);

        return $info[1];
    }

    public function getType($imageUrl)
    {
        $info = getimagesize($imageUrl);

        return $info['mime'];
    }
    
    public function calculateSize($imageUrl)
    {
        $file = new UploadedFile($imageUrl,"image");
        $size = $file->getSize();

        $sizeString = round(($size / 1024) / 1024,2)."MB";

        return $sizeString;
    }
}