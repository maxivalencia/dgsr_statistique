<?php

namespace App\Form;

use App\Entity\CtDroitPtacBak;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtDroitPtacBakType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ctGenreCategorieId')
            ->add('dpPrixMin')
            ->add('dpPrixMax')
            ->add('dpDroit')
            ->add('ctTypeDroitPtacId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtDroitPtacBak::class,
        ]);
    }
}
