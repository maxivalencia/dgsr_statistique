<?php

namespace App\Form;

use App\Entity\CtBordereau;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtBordereauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('blNumero')
            ->add('blDebutNumero')
            ->add('blFinNumero')
            ->add('blCreatedAt')
            ->add('blUpdatedAt')
            ->add('refExpr')
            ->add('dateRefExpr')
            ->add('ctImprimeTech')
            ->add('ctCentre')
            ->add('ctUser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtBordereau::class,
        ]);
    }
}
