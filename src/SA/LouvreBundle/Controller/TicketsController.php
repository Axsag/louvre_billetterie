<?php

namespace SA\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SA\LouvreBundle\Entity\Tickets;
use SA\LouvreBundle\Form\TicketsType;

class TicketsController extends Controller
{



    public function addAction()
    {
		$ticket = new Tickets();
		$form = $this->createForm(TicketsType::class, $ticket);
		$formView = $form->createView();
		return $this->render('..\Resources\views\Default\ticketAdd.html.twig', array('form'=>$formView));
    }
}
