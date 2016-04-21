<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use AppBundle\Form\CarType;

class ContractForInsurerType extends AbstractType
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
        ->add('insurer')
        ->add('car', HiddenType::class, array(
            'data' => CarType::class,
            'label' => 'Данни за автомобила',
            'mapped' => true
            ))
        ->add('driver', HiddenType::class,array(
            'label' => 'Данни за собственика',
            'mapped' => true
            
        ))
        ->add('поръчай', SubmitType::class, array(
                'attr'   =>  array(
                'class'   => 'btn btn-warning'
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
