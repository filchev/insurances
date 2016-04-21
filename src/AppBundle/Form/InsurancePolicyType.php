<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use AppBundle\Validator\Constraints\NotAllowedExtension;

class InsurancePolicyType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('client', ClientType::class, array(
                    'label' => false
                ))
                ->add('insuranceFiles', CollectionType::class, array(
                    'required' => false,
                    'entry_type' => InsurancePolicyFileType::class,
                    'entry_options' => array(
                        'label' => false
                    ),
                    'label' => "label_insurance_policy_documents",
                    'translation_domain' => 'AppBundle',
        ));

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            $insurancePolicy = $event->getData();
            $form = $event->getForm();

            $insurerConfiguration = $insurancePolicy->getInsurer()->getConfigurations();

            foreach ($insurerConfiguration as $configuration) {

                $insurancePolicy->addInsuranceFile(new \AppBundle\Entity\InsurancePolicyFile());
            }
        });
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\InsurancePolicy',
            'cascade_validation' => true,
            'error_bubbling' => true
        ));
    }

}
