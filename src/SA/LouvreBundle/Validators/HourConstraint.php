<?php

namespace SA\LouvreBundle\Validators;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HourConstraint extends Constraint
{
    public $message = "Vous ne pouvez plus prendre de tarif journée complète a partir de 14h.";
}