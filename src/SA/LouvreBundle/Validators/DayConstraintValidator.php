<?php

namespace SA\LouvreBundle\Validators;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;


class DayConstraintValidator extends ConstraintValidator
{
    
    
    public function __construct()
    {
    }
    
    public function validate($visiteDate, Constraint $constraint)
    {
        //dump($constraint->message);die;        
        $dateTimeVisite = new \DateTime($visiteDate);
        $day = $dateTimeVisite->format('%D');
        $numberDay = $dateTimeVisite->format('%z');
        if ($day = "TUE" || $numberDay = 121 || $numberDay = 305 || $numberDay = 359 )
        {
            $this->context->addViolation($constraint->message);
        }
    }

}