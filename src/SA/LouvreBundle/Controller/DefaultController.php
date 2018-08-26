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
        if ($form->isSubmitted()) 
        {
            if ($form->isValid())
            { 
                $serviceTarifs = $this->container->get('sa_louvre.calculatetarif');
                $serviceTarifs->calculateTarif($orders);dump($orders);
                $session = $request->getSession();
                $session->set('orders', $orders);
                return $this->render('SALouvreBundle:Default:recap.html.twig', array('orders'=>$orders, 'form'=>$form->createView()));
            }
            
            
            
           //$entityManager = $this->getDoctrine()->getManager();
           //$entityManager->persist($orders);
           //$entityManager->flush();
            
           //return $this->render('SALouvreBundle:Default:recap.html.twig');
        }
         
        
        
        return $this->render('SALouvreBundle:Default:index.html.twig', array('form'=>$form->createView()
            
        ));
        
        
        
    } 
    
        
    public function checkoutAction(Request $request)
    {   
        //Stripe Payment
        $session = $request->getSession();
        $prixTotal = $session->get('orders')->getPrice()*100;
        \Stripe\Stripe::setApiKey("sk_test_bd3aG1UHfzKVP5MLbGfbsL86");
        
        // Get the credit card details submitted by the form
        $token = $_POST['stripeToken'];
        
        // Create a charge: this will charge the user's card
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $prixTotal, // Amount in cents
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement louvre"
            ));
        
        //Code Reservation
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 15; $i++) 
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $session->get('orders')->setCodeReservation($randomString);
        //$session->get('orders')->setCreatedDate('2018-05-05');
        
        //Save BDD
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($session->get('orders'));
        
        $save = $em->flush();
        //dump($session->get('orders'));die;
        //email
        if ($save == true)
        {
            $email = $session->get('orders')->getEmail();
            $serviceMailer = $this->container->get('sa_louvre.sendMail');
            $serviceMailer->sendMail($session->get('orders'));
        }
        
            
            dump($serviceMailer);die;
            
        } catch(\Stripe\Error\Card $e) {
            
            dump("Nope");die;
            // The card has been declined
        }
    }
}