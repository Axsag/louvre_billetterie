<?php

namespace SA\LouvreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SA\LouvreBundle\Form\OrdersType;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    
    public function indexAction()
    {
        $orders = new \SA\LouvreBundle\Entity\Orders();
        $form = $this->createForm(OrdersType::class, $orders);
        $formView = $form->createView();
        return $this->render('SALouvreBundle:Default:index.html.twig', array('form'=>$formView));
    }
}