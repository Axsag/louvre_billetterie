<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace tests\LouvreBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
/**
 * Description of louvreControllerTest
 *
 * @author wlandry
 */
class louvreControllerTest extends WebTestCase {
 
    public function testIndex() {
     $client = static::createClient();
     $client->request('GET','/');
     $this->assertSame(200,$client->getResponse()->getStatusCode());
    }
    
    public function testBilleterie() {
     $client = static::createClient();
     $client->request('GET','/billeterie');
     $this->assertSame(200,$client->getResponse()->getStatusCode());
    }
    
    public function testStripeForm() {
     $client = static::createClient();
     $client->request('GET','/stripeForm');
     $this->assertSame(302,$client->getResponse()->getStatusCode());
    }
    
    public function testStripePayment() {
     $client = static::createClient();
     $client->request('GET','/stripePayment');
     $this->assertSame(302,$client->getResponse()->getStatusCode());
    }
}