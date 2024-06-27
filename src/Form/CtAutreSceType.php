<?php

namespace App\Form;

use App\Entity\CtAutreSce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtAutreSceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ctControleId')
            ->add('asDate')
            ->add('asCreated')
            ->add('asUpdated')
            ->add('asIsDeleted')
            ->add('asMotifDeleted')
            ->add('asValiditeFumee')
            ->add('asItineraireSpeciale')
            ->add('asValiditeSpeciale')
            ->add('asDeleted')
            ->add('asNumPv')
            ->add('ctUtilisation')
            ->add('ctCentre')
            ->add('ctCarteGrise')
            ->add('ctVerificateur')
            ->add('ctUser')
            ->add('ctOptionVitreFumee')
            ->add('ctTypeAutreSce')
            ->add('ctImprimeTech')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtAutreSce::class,
        ]);
    }
}
