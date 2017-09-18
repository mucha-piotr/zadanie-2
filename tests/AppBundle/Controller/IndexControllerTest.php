<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 17.09.2017
 * Time: 10:40
 */

namespace tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class IndexControllerTest extends WebTestCase
{
    public function testIndexAction()
    {
        $client = static::createClient();


        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Nie przesłano zdjęcia', $crawler->text());

        $client->restart();
        
        
    }
    
    public function testUpload()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        
        $image = new UploadedFile("image.jpg","image.jpg");

        $form = $crawler->filter('form')->form();

        $form['upload[image]']->setValue($image);

        $crawler = $client->submit($form);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('img', $crawler->html());

    }


}