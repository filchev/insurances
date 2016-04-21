<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use AppBundle\Form\CarType;

class ContractCalculatorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    
    
    public function __construct ()
    {
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        ->setMethod('POST')
        ->add('car', CarType::class, array(
            'label' => 'label_car_info',
            'translation_domain' => 'AppBundle'
            ))
        ->add('driver', DriverType::class,array(
            'label' => 'label_driver_info',
            'translation_domain' => 'AppBundle'
            
        ))
        ->add('Направи справка', SubmitType::class, array(
                'label' => 'btn_insurance_policy_next',
                'translation_domain' => 'AppBundle',
                'attr'   =>  array(
                'class'   => 'btn btn-success',
                'ng-submit' => 'submit()'
                )
        ));
        
        $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event){

            $form = $event->getForm();
            
        });
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }
}
