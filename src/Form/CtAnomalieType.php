<?php

namespace App\Form;

use App\Entity\CtAnomalie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtAnomalieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('anmlLibelle')
            ->add('anmlCode')
            ->add('ctAnomalieType')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtAnomalie::class,
        ]);
    }
}
