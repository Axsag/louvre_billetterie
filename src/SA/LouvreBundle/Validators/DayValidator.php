<?php

namespace SA\LouvreBundle\Validators;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;


class DayValidator extends ConstraintValidator
{
    
    /**
     * @var EntityManager
     */
    protected $em;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }
    
    public function dayTickets($visiteDate)
    {
        
        $dateTimeVisite = new \DateTime($visiteDate);
        $day = $dateTimeVisite->format('%D');
        $numberDay = $dateTimeVisite->format('%z');
        if ($day = "TUE" || $numberDay = 121 || $numberDay = 305 || $numberDay = 359 )
        {
            $this->context->buildViolation($constraint->message);
        }
    }
}