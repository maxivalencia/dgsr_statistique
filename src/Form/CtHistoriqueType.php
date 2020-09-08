<?php

namespace App\Form;

use App\Entity\CtHistorique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtHistoriqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hstDescription')
            ->add('hstDateCreate')
            ->add('hstIsView')
            ->add('ctCentreId')
            ->add('histType')
            ->add('ctUser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtHistorique::class,
        ]);
    }
}
