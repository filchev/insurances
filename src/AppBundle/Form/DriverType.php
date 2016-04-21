<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
class DriverType extends AbstractType
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
        ->add('age', NumberType::class,[
            'label'=> "label_driver_age",
            'translation_domain' => 'AppBundle'])
        ->add('accident', EntityType::class,[
            'label'         => "label_driver_accident",
            'translation_domain' => 'AppBundle',
            'class'         => 'AppBundle\Entity\Driver\Accident',
            'query_builder' => function (EntityRepository $er) {
                $qb = $er->createQueryBuilder('a');
                return $qb->orderBy('a.title', 'ASC');
            }])
        ->add('experience', EntityType::class,[
            'label'         => "label_driver_experience",
            'translation_domain' => 'AppBundle',
            'class'         => 'AppBundle\Entity\Driver\Experience',
            'query_builder' => function (EntityRepository $er) {
                $qb = $er->createQueryBuilder('a');
                return $qb->orderBy('a.title', 'ASC');
            }]);
        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Driver\Driver'
        ));
    }
}
