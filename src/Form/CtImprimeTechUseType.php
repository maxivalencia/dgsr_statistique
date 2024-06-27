<?php

namespace App\Form;

use App\Entity\CtImprimeTechUse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtImprimeTechUseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ctControleId')
            ->add('ituNumero')
            ->add('ituUsed')
            ->add('ituMotifUsed')
            ->add('activedAt')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('ituObservation')
            ->add('ctImprimeTech')
            ->add('ctBordereau')
            ->add('ctCentre')
            ->add('ctUser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtImprimeTechUse::class,
        ]);
    }
}
