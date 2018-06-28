<?php

namespace SA\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SA\LouvreBundle\Entity\Tickets;
use SA\LouvreBundle\Form\TicketsType;

class TicketController extends Controller
{



    public function addAction()
    {
		$ticket = new Tickets();
		$form = $this->createForm(TicketsType::class, $ticket);
		$formView = $form->createView();
		return $this->render('ticketAdd.html.twig', array('form'=>$formView));
    }
}
