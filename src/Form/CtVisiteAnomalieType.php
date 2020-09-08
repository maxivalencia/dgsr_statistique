<?php

namespace App\Form;

use App\Entity\CtVisiteAnomalie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtVisiteAnomalieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ctAnomalieId')
            ->add('ctVisiteId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtVisiteAnomalie::class,
        ]);
    }
}
