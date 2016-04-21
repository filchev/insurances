<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class NotAllowedExtension extends Constraint
{
    public $message = 'The file "%string%" contains an illegal extension.';
}