<?php

namespace App\Form;

use App\Entity\CtReception;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtReceptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rcpMiseService')
            ->add('rcpImmatriculation')
            ->add('rcpProprietaire')
            ->add('rcpProfession')
            ->add('rcpAdresse')
            ->add('rcpNbrAssis')
            ->add('rcpNbrDebout')
            ->add('rcpNumPv')
            ->add('rcpNumGroup')
            ->add('rcpCreated')
            ->add('ctVehicule')
            ->add('ctMotif')
            ->add('ctTypeReception')
            ->add('ctUtilisation')
            ->add('ctSourceEnergie')
            ->add('ctCentre')
            ->add('ctUser')
            ->add('ctGenre')
            ->add('ctCarosserie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtReception::class,
        ]);
    }
}
