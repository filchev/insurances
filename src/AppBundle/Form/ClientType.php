<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ClientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('names', TextType::class, array(
                'label'              => "label_client_names",
                'translation_domain' => 'AppBundle',
            ))
            ->add('email', EmailType::class, array(
                'label'              => "label_client_email",
                'translation_domain' => 'AppBundle',
            ))
            ->add('mobilePhone', TextType::class, array(
                'label'              => "label_client_mobile_phone",
                'translation_domain' => 'AppBundle',
            ))
            ->add('dob', DateType::class, array(
                'label'              => "label_client_dob",
                'translation_domain' => 'AppBundle',
            ))
            ->add('addressCity', TextType::class, array(
                'label'              => "label_client_address_city",
                'translation_domain' => 'AppBundle',
            ))
            ->add('addressArea',  TextType::class, array(
                'label'              => "label_client_address_area",
                'translation_domain' => 'AppBundle',
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Client'
        ));
    }
}
