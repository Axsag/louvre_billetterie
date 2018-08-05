<?php

namespace SA\LouvreBundle\Validators;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;


class HourConstraintValidator extends ConstraintValidator
{
    
    /**
     * @var EntityManager
     */
   /* protected $em;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }*/
    
    public function __construct()
    {
    }
    
    /*public function hourTickets()
    {
        
        $timeNow = new \DateTime('now');
        $hour = $timeNow->format('%G');
        if ($hour >= 14 && $ticketType->getTypeOrder == 1)
        {
            $this->context->addViolation($constraint->message);
        }
    }*/
    
    public function validate($ticketType, Constraint $constraint)
    {
        $timeNow = new \DateTime('now');
        $hour = $timeNow->format('%G');
        if ($hour >= 14)
        {
            if ($ticketType == 1)
            {
                $this->context->addViolation($constraint->message);
            }
        }
    }

}