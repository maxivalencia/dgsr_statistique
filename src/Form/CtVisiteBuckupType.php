<?php

namespace App\Form;

use App\Entity\CtVisiteBuckup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtVisiteBuckupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ctCarteGriseId')
            ->add('ctCentreId')
            ->add('ctTypeVisiteId')
            ->add('ctUsageId')
            ->add('ctUserId')
            ->add('ctVerificateurId')
            ->add('vstNumPv')
            ->add('vstNumFeuilleCaisse')
            ->add('vstDateExpiration')
            ->add('vstCreated')
            ->add('vstUpdated')
            ->add('ctUtilisationId')
            ->add('vstIsApte')
            ->add('vstIsContreVisite')
            ->add('vstDureeReparation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtVisiteBuckup::class,
        ]);
    }
}
