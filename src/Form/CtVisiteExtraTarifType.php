<?php

namespace App\Form;

use App\Entity\CtVisiteExtraTarif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtVisiteExtraTarifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vetAnnee')
            ->add('vetPrix')
            ->add('ctVisiteExtra')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtVisiteExtraTarif::class,
        ]);
    }
}
