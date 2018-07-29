<?php

namespace SA\LouvreBundle\Validators;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DayConstraint extends Constraint
{
    public $message = "Vous ne pouvez pas réserver de billets les mardis ou les jours fériés.";
}