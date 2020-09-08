<?php

namespace App\Form;

use App\Entity\CtConstAvDed;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtConstAvDedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cadProvenance')
            ->add('cadDivers')
            ->add('cadProprietaireNom')
            ->add('cadProprietaireAdresse')
            ->add('cadBonEtat')
            ->add('cadSecPers')
            ->add('cadSecMarch')
            ->add('cadProtecEnv')
            ->add('cadNumero')
            ->add('cadImmatriculation')
            ->add('cadDateEmbarquement')
            ->add('cadLieuEmbarquement')
            ->add('cadCreated')
            ->add('cadConforme')
            ->add('cadObservation')
            ->add('ctCentre')
            ->add('ctVerificateur')
            ->add('constAvDedCarac')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtConstAvDed::class,
        ]);
    }
}
