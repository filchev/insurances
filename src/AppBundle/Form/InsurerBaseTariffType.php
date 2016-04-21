<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsurerBaseTariffType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amount', \Symfony\Component\Form\Extension\Core\Type\NumberType::class, array(
                    'label' => "label_amount",
                    'translation_domain' => 'AppBundle',
            ))
            ->add('tariffCategories', EntityType::class, array(
                    'label' => "label_category",
                    'translation_domain' => 'AppBundle',
                    'class' => 'AppBundle:CategoryAbstract',
                    'property' => 'title',
                    'query_builder' => function (EntityRepository $repository) {
                        return $repository->createQueryBuilder('c');
                    },
                    'multiple' => true,
                    'mapped' => false,
                    'group_by' => 'category'
            ))
            ->add('insurer', EntityType::class, array(
                'label' => "label_insurer",
                'translation_domain' => 'AppBundle',
                'class' => 'AppBundle:Insurer',
                'query_builder' => function (EntityRepository $repository) {
                        return $repository->createQueryBuilder('c');
                    }
            ));
                   
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\InsurerBaseTariff'
        ));
    }
}
