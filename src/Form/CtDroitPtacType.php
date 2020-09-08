<?php

namespace App\Form;

use App\Entity\CtDroitPtac;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtDroitPtacType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dpPrixMin')
            ->add('dpPrixMax')
            ->add('dpDroit')
            ->add('ctGenreCategorie')
            ->add('ctTypeDroitPtac')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtDroitPtac::class,
        ]);
    }
}
