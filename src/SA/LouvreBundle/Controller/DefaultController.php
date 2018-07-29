<?php

namespace SA\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SA\LouvreBundle\Form\OrdersType;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    
    public function indexAction(Request $request)
    {
        $serviceTarifs = $this->container->get('sa_louvre.calculatetarif');
        $orders = new \SA\LouvreBundle\Entity\Orders();
        $form = $this->createForm(OrdersType::class, $orders);        
        
       
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $serviceTarifs = $this->container->get('sa_louvre.calculatetarif');
            $serviceTarifs->calculateTarif($orders);
            dump($orders);die;
                        
            
           //$entityManager = $this->getDoctrine()->getManager();
           //$entityManager->persist($orders);
           //$entityManager->flush();
            
            //return $this->render('SALouvreBundle:Default:recap.html.twig');
        }
        
        return $this->render('SALouvreBundle:Default:index.html.twig', array('form'=>$form->createView()
            
        ));
        
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        //\Stripe\Stripe::setApiKey("sk_test_bd3aG1UHfzKVP5MLbGfbsL86");
        
        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        //$token = $_POST['stripeToken'];
        //$charge = \Stripe\Charge::create([
        //   'amount' => 2000,
        //    'currency' => 'eur',
        //    'description' => 'Example charge',
        //    'source' => $token,
        //]);
        
    }    
}