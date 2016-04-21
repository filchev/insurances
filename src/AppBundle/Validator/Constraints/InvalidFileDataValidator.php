<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class InvalidFileDataValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
            if($value){
                
                $imageSize = getimagesize($value);
                $fileName = $value->getClientOriginalName();

                if (!$imageSize) {
                    $this->context->buildViolation($constraint->message)
                        ->setParameter('%string%', $fileName)
                        ->addViolation();
                }
            }
           
    }
}