<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsCarotte extends Constraint
{
    public $message = " '{{ string }}' est un mot interdit! ";
}