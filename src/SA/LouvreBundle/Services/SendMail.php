<?php

namespace SA\LouvreBundle\Services;



class SendMail
{
    public $mailer;
    
    public function __construct($mailer, $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }
    
    
    public function sendMail($orders, $tickets)
    {
        $contenu = $this->templating->render('SALouvreBundle:Default:mail.html.twig', array(
            'orders'    =>$orders,
            'tickets'   =>$tickets
        ));
        $message = \Swift_Message::newInstance()
        ->setSubject('Votre réservation : [' .$orders->getCodeReservation() . ']')
        ->setFrom('noreply@gmail.com')
        ->setTo($orders->getEmail())        
        ->setContentType('text/html')
        /*->setBody($this->renderView('@SALouvreBundle:Default:mail.html.twig', array(
            'orders'    =>$orders,
            'tickets'   =>$tickets
        )))*/
        ->setBody($contenu)
        ;
        // Envoi du mail
        $success = $this->mailer->send($message);
        //dump($message, $success);
    
    }
}

