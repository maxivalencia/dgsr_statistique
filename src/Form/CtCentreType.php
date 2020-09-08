<?php

namespace App\Form;

use App\Entity\CtCentre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtCentreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ctrNom')
            ->add('ctrCode')
            ->add('ctrCreatedAt')
            ->add('ctrUpdatedAt')
            ->add('ctProvince')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtCentre::class,
        ]);
    }
}
