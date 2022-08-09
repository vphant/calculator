<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class InputValueValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (empty($value)) {
            return;
        }

        // string cannot contain anything except digit, dot and operation symbols
        if (preg_match('/[^0-9\.\-\+\*\/]+/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation()
            ;
        }

        // validate that string is a correct expression (we can also use "-" before a number)
        if (!preg_match('/^-?[\d]+(\.\d+)?([-+*\/]-?[\d]+(\.\d+)?)*$/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation()
            ;
        }
    }
}
