<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarEngineCapacityTariffType extends AbstractType
{
    private $user;
    
    public function __construct ($user = null)
    {
        
        $this->user = $user;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->user;
        
        $builder
            ->add('insurer', EntityType::class, array(
                'label' => 'Застраховател',
                'class' => 'AppBundle:Insurer',
                'query_builder' => function (EntityRepository $repository) use ($user) {
                    return $repository->createQueryBuilder('t')
                            ->andWhere('t.user = :user')
                            ->setParameter('user', $user);
            }))
            ->add('categoryOption', EntityType::class, array(
                'label' => 'Опция',
                'class' => 'AppBundle:CategoryAbstract',
                'query_builder' => function (EntityRepository $repository){
                    return $repository->createQueryBuilder('c')
                        ->andWhere('c INSTANCE OF (:entity)')
                        ->setParameter('entity', 'EngineCapacity');
            }))
            ->add('isDiscount', CheckboxType::class, array(
                'label' => 'Отстъпка',
                'required' => false
            ))
            ->add('isPercent', CheckboxType::class, array(
                'label' => 'Процент',
                'required' => false
            ))
            ->add('amount','number',array(
                'label' => 'Сума'
            ));
        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Car\EngineCapacityTariff'
        ));
    }
}
