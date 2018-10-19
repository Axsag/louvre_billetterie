<?php

namespace SA\LouvreBundle\Validators;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;


class SoldDaysConstraintValidator extends ConstraintValidator
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
        
        
    }
    
    
    public function validate($visiteDate, Constraint $constraint)
    {
        $totalTickets = 0;    
        $dateTimeVisite      = new \DateTime($visiteDate);
        $totalTickets        = 0;
        $ordersOfCurrentDay  = $this->em->getRepository('SALouvreBundle:Orders')->findBy(array('visiteDate'=> $dateTimeVisite ));
        if ( !empty($ordersOfCurrentDay) )
            {
                foreach ( $ordersOfCurrentDay as $row )
                {
                    $billets = $this->em->getRepository('SALouvreBundle:Tickets')->findBy( array('order'=> $row->getId()) );
                    $totalTickets += sizeof($billets);
                }
            }
        
        if ( $totalTickets > 1000 ) {
            
            $this->context->addViolation($constraint->message);
        }
        
    }
    

}

//