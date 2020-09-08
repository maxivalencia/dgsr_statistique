<?php

namespace App\Form;

use App\Entity\CtCarteGrise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtCarteGriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cgDateEmission')
            ->add('cgNom')
            ->add('cgPrenom')
            ->add('cgProfession')
            ->add('cgAdresse')
            ->add('cgCommune')
            ->add('cgNbrAssis')
            ->add('cgNbrDebout')
            ->add('cgPuissanceAdmin')
            ->add('cgMiseEnService')
            ->add('cgPatente')
            ->add('cgAni')
            ->add('cgRta')
            ->add('cgNumCarteViolette')
            ->add('cgDateCarteViolette')
            ->add('cgLieuCarteViolette')
            ->add('cgNumVignette')
            ->add('cgDateVignette')
            ->add('cgLieuVignette')
            ->add('cgImmatriculation')
            ->add('cgCreated')
            ->add('cgNomCooperative')
            ->add('cgItineraire')
            ->add('cgIsTransport')
            ->add('cgNumIdentification')
            ->add('cgZoneDeserte')
            ->add('ctVehicule')
            ->add('ctSourceEnergie')
            ->add('ctCentre')
            ->add('ctZoneDeserte')
            ->add('ctCarosserie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtCarteGrise::class,
        ]);
    }
}
