<?php

namespace tests\AppBundle\Service;

use AppBundle\Service\Image;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImageTest extends WebTestCase
{

    public function testGetWidth()
    {
        $image = new Image();
        
        $file = "image.jpg";
        
        $this->assertEquals(1464,$image->getWidth($file));
    }

    public function testGetHeight()
    {
        $image = new Image();

        $file = "image.jpg";

        $this->assertEquals(1464,$image->getHeight($file));
    }

    public function testGetType()
    {
        $image = new Image();

        $file = "image.jpg";

        $this->assertEquals("image/jpeg",$image->getType($file));
    }

    public function testCalculateSize()
    {
        $image = new Image();

        $file = "image.jpg";

        $this->assertEquals("0.11MB",$image->calculateSize($file));
    }
    
    public function testFlipImage()
    {
        exec('cp image-default.jpg image.jpg');
        $image = new Image();
        $file = "image.jpg";
        $file_default = "image-default.jpg";
        
        
        $gm1 = new \Gmagick($file_default);
        
        $image->flipImage($file);
        $gm2 = new \Gmagick($file);
        
        $this->assertNotEquals($gm2->getimagesignature(),$gm1->getimagesignature());
    }
}