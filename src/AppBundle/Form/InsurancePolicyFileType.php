<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class InsurancePolicyFileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('file',  \Symfony\Component\Form\Extension\Core\Type\FileType::class, array(
                'label_format' => 'filename'
            ));
        
            $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            
            $insurancePolicy = $event->getData();
            $form = $event->getForm();


        });
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\InsurancePolicyFile'
        ));
    }
    
}
