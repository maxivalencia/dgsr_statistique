<?php

namespace App\Form;

use App\Entity\CtGenreTarif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtGenreTarifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grtPrix')
            ->add('grtAnnee')
            ->add('ctGenre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtGenreTarif::class,
        ]);
    }
}
