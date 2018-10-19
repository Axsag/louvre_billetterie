<?php


namespace tests\LouvreBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class DefaultControllerTest extends WebTestCase {
    
    public function testIndexAction() {
        $client = static::createClient();
        $client->request('GET','/');
        $this->assertSame(200,$client->getResponse()->getStatusCode());
    }
    
    public function testRecapAction() {
        $client = static::createClient();
        $client->request('GET','/recap');
        $this->assertSame(302,$client->getResponse()->getStatusCode());
    }
    
    public function testCheckoutAction() {
        $client = static::createClient();
        $client->request('GET','/checkout');
        $this->assertSame(302,$client->getResponse()->getStatusCode());
    }
    
    public function testSuccessAction() {
        $client = static::createClient();
        $client->request('GET','/success');
        $this->assertSame(200,$client->getResponse()->getStatusCode());
    }
}