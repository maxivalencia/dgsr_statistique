<?php

namespace App\Form;

use App\Entity\CtUsage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtUsageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usgLibelle')
            ->add('usgValidite')
            ->add('usgCreated')
            ->add('ctTypeUsage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtUsage::class,
        ]);
    }
}
