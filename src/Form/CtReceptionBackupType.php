<?php

namespace App\Form;

use App\Entity\CtReceptionBackup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtReceptionBackupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ctCentreId')
            ->add('ctMotifId')
            ->add('ctTypeReceptionId')
            ->add('ctUserId')
            ->add('ctUtilisationId')
            ->add('ctVehiculeId')
            ->add('rcpMiseService')
            ->add('rcpImmatriculation')
            ->add('rcpProprietaire')
            ->add('rcpProfession')
            ->add('rcpAdresse')
            ->add('rcpNbrAssis')
            ->add('rcpNbrDebout')
            ->add('rcpNumPv')
            ->add('ctSourceEnergieId')
            ->add('ctCarosserieId')
            ->add('rcpNumGroup')
            ->add('rcpCreated')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtReceptionBackup::class,
        ]);
    }
}
