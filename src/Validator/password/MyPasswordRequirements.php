<?php

namespace App\Validator\password;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;
use Webmozart\Assert\Assert as AssertAssert;

/**
 * @Annotation
 *
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class MyPasswordRequirements extends Constraint
{
    public $constraints = [];

    public function __construct($options = null, $groups = null, $payload = null)
    {
        parent::__construct($options, $groups, $payload);

        // Ajoutez vos contraintes ici
        $this->constraints = [
            new Assert\NotBlank(['message' => 'Ce champ ne peut pas être vide.']),
            new Assert\Length(['min' => 12, 'minMessage' => 'La longueur minimale du mot de passe est de {{ limit }} caractères.']),
            new Assert\Regex(['pattern' => '/[A-Z]/', 'message' => 'Votre mot de passe doit avoir au une majuscule.']),
            new Assert\Regex(['pattern' => '/[0-9]/', 'message' => 'Votre mot de passe doit avoir au moins un chiffre entre 1 et 9.']),
            new Assert\Regex(['pattern' => '/[!@#$%^&*(),.?":{}|<>]/', 'message' => 'Votre mot de passe doit avoir un caractère spécial.']),
        ];
    }
}
