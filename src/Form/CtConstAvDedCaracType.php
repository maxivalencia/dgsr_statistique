<?php

namespace App\Form;

use App\Entity\CtConstAvDedCarac;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtConstAvDedCaracType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cadCylindre')
            ->add('cadPuissance')
            ->add('cadPoidsVide')
            ->add('cadChargeUtile')
            ->add('cadHauteur')
            ->add('cadLargeur')
            ->add('cadLongueur')
            ->add('cadNumSerieType')
            ->add('cadNumMoteur')
            ->add('cadTypeCar')
            ->add('cadPoidsMaxima')
            ->add('cadPoidsTotalCharge')
            ->add('cadPremiereCircule')
            ->add('cadNbrAssis')
            ->add('ctSourceEnergie')
            ->add('ctMarque')
            ->add('ctConstAvDedType')
            ->add('ctGenre')
            ->add('ctCarosserie')
            ->add('constAvDed')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtConstAvDedCarac::class,
        ]);
    }
}
