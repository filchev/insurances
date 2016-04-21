<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotAllowedExtensionValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        
        $allowedExtensions = array('jpg', 'png', 'bmp', 'gif', 'jpeg');
        
            if($value){
                
            $fileExtension = $value->getClientOriginalExtension();
            $fileName = $value->getClientOriginalName();    
                
                if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
                    $this->context->buildViolation($constraint->message)
                        ->setParameter('%string%', $fileName)
                        ->addViolation();
                }
            }
           
    }
}