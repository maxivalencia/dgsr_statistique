<?php

namespace App\Form;

use App\Entity\CtMotifTarif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtMotifTarifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mtfTrfPrix')
            ->add('mtfTrfDate')
            ->add('ctMotif')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtMotifTarif::class,
        ]);
    }
}
