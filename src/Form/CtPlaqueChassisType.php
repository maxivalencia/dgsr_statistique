<?php

namespace App\Form;

use App\Entity\CtPlaqueChassis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtPlaqueChassisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plqType')
            ->add('plqTarif')
            ->add('ctArretePrix')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtPlaqueChassis::class,
        ]);
    }
}
