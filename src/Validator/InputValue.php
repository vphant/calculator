<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class InputValue extends Constraint
{
    public $message = 'Invalid format';
}
