<?php

namespace SA\LouvreBundle\Validators;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SoldDaysConstraint extends Constraint
{
    public $message = "La limite de 1000billets vendus pour ce jour a été atteinte, veuillez selectionner un autre jour.";
}