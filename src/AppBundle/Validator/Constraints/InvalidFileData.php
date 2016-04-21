<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class InvalidFileData extends Constraint
{
    public $message = 'The file "%string%" contains an illegal file data.';
}