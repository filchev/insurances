<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\CategoryTranslationType;

class CategoryAbstractType extends AbstractType
{
    
    
    protected $em;

    public function __construct(EntityManager $em) 
    {
        $this->em = $em;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label'              => "label_title",
                'translation_domain' => 'AppBundle',
            ))
            ->add('category', EntityType::class, array(
                'label'              => "label_title",
                'translation_domain' => 'AppBundle',
                'class' => 'AppBundle:CategoryGroup',
                'query_builder' => function (EntityRepository $repository){
                    return $repository->createQueryBuilder('cg');
            }))
            ->add('translations', CollectionType::class, array(
                    'required' => false,
                    'entry_type' => CategoryTranslationType::class,
                    'entry_options' => array(
                        'label' => false
                    ),
                    'label' => "label_insurance_policy_documents",
                    'translation_domain' => 'AppBundle',
            ));
        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CategoryAbstract'
        ));
    }
}
