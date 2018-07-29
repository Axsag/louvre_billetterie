<?php

namespace SA\LouvreBundle\Validators;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;


class SoldDaysValidator extends ConstraintValidator
{
    
    /**
     * @var EntityManager
     */
    protected $em;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }
    
    public function dailyTickets($visiteDate)
    {
        
        // On calcule le nombre total de ticket en BDD
        $totalTickets = 0;
        if ( $visiteDate ) 
        {
            $dateTimeVisite      = new \DateTime($visiteDate);
            $totalTickets        = 0;
            $ordersOfCurrentDay  = $this->em->getRepository('SALouvreBundle:Orders')->findBy(array('createdDate'=> $dateTimeVisite ));
            if ( !empty($ordersOfCurrentDay) ) 
            {
                foreach ( $ordersOfCurrentDay as $row )
                {
                    $billets = $this->em->getRepository('SALouvreBundle:Ticket')->findBy( array('orders'=> $row->getId()) );
                    $totalTickets += sizeof($tickets);
                }
            }
        }
        
        if ( $totalTickets > 1000 ) {
            $this->context->buildViolation($constraint->message)->atPath('type')->addViolation();
        }
    }
}