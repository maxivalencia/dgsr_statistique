<?php

namespace App\Form;

use App\Entity\CtVisite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtVisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vstNumPv')
            ->add('vstNumFeuilleCaisse')
            ->add('vstDateExpiration')
            ->add('vstCreated')
            ->add('vstUpdated')
            ->add('vstIsApte')
            ->add('vstIsContreVisite')
            ->add('vstDureeReparation')
            ->add('ctUtilisation')
            ->add('ctCentre')
            ->add('ctTypeVisite')
            ->add('ctCarteGrise')
            ->add('ctUsage')
            ->add('ctVerificateur')
            ->add('ctUser')
            ->add('ctVisiteExtra')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtVisite::class,
        ]);
    }
}
