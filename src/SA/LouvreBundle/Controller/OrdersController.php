<?php

namespace SA\LouvreBundle\Controller;

use SA\LouvreBundle\Form\TicketsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\component\routing\annotation\route


Class OrdersController extends Controller
{



    public function addAction()
    {
		$orders = new \SA\LouvreBundle\Entity\Orders();
		$form = $this->createForm(TicketsType::class, $orders);
		$formView = $form->createView();
		return $this->render('..\Resources\views\Default\ordersView.html.twig', array('form'=>$formView));
    }
}