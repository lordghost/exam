<?php

namespace Api\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('kod')
            ->add('garant')
            ->add('cenaDyler')
            ->add('cenaGurt')
            ->add('cenaRozdrib')
            ->add('category')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Api\ApiBundle\Entity\Product'
        ));
    }

    public function getName()
    {
        return 'api_apibundle_producttype';
    }
}
