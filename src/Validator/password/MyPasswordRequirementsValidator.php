<?php

namespace App\Validator\password;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Validation;

class MyPasswordRequirementsValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var App\Validator\MyPasswordRequirements $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        // Valider chaque contrainte individuelle
        $validator = Validation::createValidator();
        $violations = $validator->validate($value, $constraint->constraints);

        // Ajouter les violations à notre contexte de validation actuel
        foreach ($violations as $violation) {
            $this->context->buildViolation($violation->getMessage())
                ->addViolation();
        }
    }
}
