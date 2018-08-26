<?php

namespace SA\LouvreBundle\Services;



class SendMail
{
    public $mailer;
    
    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }
    
    
    public function sendMail($orders)
    {
        $email = $order->setEmail('axel.saglier@gmail.com');
        $message = \Swift_Message::newInstance()
        ->setSubject('Votre réservation : [' .$orders->getCodeReservation() . ']')
        ->setFrom('noreply@gmail.com')
        ->setTo($orders->getEmail())
        //->setTo('camillekanza@gmail.com')
        ->setContentType('text/html')
        /*->setBody($this->renderView('SALouvreBundle:Default:mail.html.twig', array(
            'orders'    =>$orders,
            'tickets'   =>$tickets
        )))*/
        ->setBody('Commande confirmée')
        ;
        // Envoi du mail
        $success = $this->mailer->send($message);
        dump($message, $success);die;
    
    }
}

