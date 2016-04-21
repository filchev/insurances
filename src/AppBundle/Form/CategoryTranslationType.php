<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryTranslationType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    { 
        
        $builder
            ->add('content', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array(
                'label' => 'label_title',
                'translation_domain' => 'AppBundle',
            ));
        
       
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CategoryTranslation'
        ));
    }
}
