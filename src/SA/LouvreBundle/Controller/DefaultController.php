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
        
        
        $orders = new \SA\LouvreBundle\Entity\Orders();
        $form = $this->createForm(OrdersType::class, $orders);        
        
        
        $form->handleRequest($request);
        if ($form->isSubmitted()) 
        {
            if ($form->isValid())
            { 
                $serviceTarifs = $this->container->get('sa_louvre.calculatetarif');
                $serviceTarifs->calculateTarif($orders);
                $session = $request->getSession();
                $session->set('orders', $orders);
                return $this->redirectToRoute('sa_louvre_recap');
            }
        }
         
        return $this->render('SALouvreBundle:Default:index.html.twig', array('form'=>$form->createView()));   
    } 
    
    
    /**
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function recapAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('orders') == null) {
            return $this->redirectToRoute('sa_louvre_homepage');
        }
        // On récupère notre objet commande précédement sauvegardé en session, pour afficher le récap de notre formulaire
        $session = $request->getSession();
        $orders = $session->get("orders");
        return $this->render('SALouvreBundle:Default:recap.html.twig', array('orders' => $orders));
    }
    
    /**
     *
     * @param Request $request
     */ 
    public function checkoutAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('orders') == null) {
            return $this->redirectToRoute('sa_louvre_homepage');
        }
        // On récupère les données de la commande sauvegardées en session pour mettre à jour certains champs
        $session = $request->getSession();
        $orders = $session->get("orders");
        $tickets = $session->get("tickets");
        
        // On récupère l'adresse email précédement saisie
        $email = $request->get('sa_louvrebundle_orders_email');
        $orders->setEmail($email);
        
        //Stripe Payment
        $session   = $request->getSession();
        
        // Get the credit card details submitted by the form
        $token = $request->get('stripeToken');
                
        // Create a charge: this will charge the user's card
        try {
            $serviceStripe = $this->container->get('sa_louvre.stripe');
            $stripecheckout = $serviceStripe->stripeCheckout($token, $session->get('orders')->getPrice());
            
            // Vérification si le paiement OK
            if ( $stripecheckout instanceof \Stripe\Charge && $stripecheckout->paid == true ) {
                
                //Sauvegarde en BDD
                $em = $this->getDoctrine()->getManager();
                $em->persist($orders);
                $em->flush();
                
                // Si sauvegardé en BDD OK, envoi d'un mail de récap
                if ($orders->getId() == true)
                {
                    $email = $orders->getEmail();
                    $serviceMailer = $this->container->get('sa_louvre.sendMail');
                    $serviceMailer->sendMail($orders, $tickets);
                    
                    // ........
                    
                    // ...... Ne pas oublier de détruire la session à la fin
                    $request->getSession()->invalidate(1);

                    return $this->redirectToRoute('sa_louvre_success');
                }
                
            }
            else {
                return $this->render('SALouvreBundle:Default:error.html.twig');
            }
            
        } catch(\Stripe\Error\Card $e) {
            dump("Erreur Token Stripe");die;
        }
        
    }
    public function successAction(Request $request)
    {
        return $this->render('SALouvreBundle:Default:success.html.twig');
    }
    
}