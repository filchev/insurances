<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
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
        ->add('category', EntityType::class,[
            'label'         => "label_car_category",
            'translation_domain' => 'AppBundle',
            'class'         => 'AppBundle\Entity\CategoryAbstract',
            'query_builder' => function (EntityRepository $er) {
            return $er->createQueryBuilder('a')
                        ->andWhere('a INSTANCE OF (:entity)')
                        ->setParameter('entity', 'CarCategory');
            }])
        ->add('region', EntityType::class,[
            'label'         => "label_car_region",
            'translation_domain' => 'AppBundle',
            'class'         => 'AppBundle\Entity\Car\Region',
            'query_builder' => function (EntityRepository $er) {
                $er->createQueryBuilder('a')
                        ->andWhere('a INSTANCE OF (:entity)')
                        ->setParameter('entity', 'CarRegion');
                
            }])
        ->add('registrationNumber', EntityType::class,[
            'label'         => "label_car_registration_number",
            'translation_domain' => 'AppBundle',
            'class'         => 'AppBundle\Entity\Car\RegistrationNumber',
            'query_builder' => function (EntityRepository $er) {
                $er->createQueryBuilder('a')
                        ->andWhere('a INSTANCE OF (:entity)')
                        ->setParameter('entity', 'CarRegistrationNumber');
            }])
        ->add('engineCapacity', EntityType::class,[
            'label'         => "label_car_engine_capacity",
            'translation_domain' => 'AppBundle',
            'class'         => 'AppBundle\Entity\Car\EngineCapacity',
            'query_builder' => function (EntityRepository $er) {
                $er->createQueryBuilder('a')
                        ->andWhere('a INSTANCE OF (:entity)')
                        ->setParameter('entity', 'CarEngineCapacity');
            }])
        ->add('rightDirection', EntityType::class,[
            'label'         => "label_car_right_direction",
            'translation_domain' => 'AppBundle',
            'class'         => 'AppBundle\Entity\Car\RightDirection',
            'query_builder' => function (EntityRepository $er) {
                $er->createQueryBuilder('a')
                        ->andWhere('a INSTANCE OF (:entity)')
                        ->setParameter('entity', 'CarRightDirection');
            }]);
        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Car\Car'
        ));
    }
}
