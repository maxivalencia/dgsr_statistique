<?php

namespace App\Form;

use App\Entity\CtVehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtVehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vhcCylindre')
            ->add('vhcPuissance')
            ->add('vhcPoidsVide')
            ->add('vhcChargeUtile')
            ->add('vhcHauteur')
            ->add('vhcLargeur')
            ->add('vhcLongueur')
            ->add('vhcNumSerie')
            ->add('vhcNumMoteur')
            ->add('vhcCreated')
            ->add('vhcProvenance')
            ->add('vhcType')
            ->add('vhcPoidsTotalCharge')
            ->add('ctMarque')
            ->add('ctGenre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtVehicule::class,
        ]);
    }
}
