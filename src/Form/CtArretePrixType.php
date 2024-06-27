<?php

namespace App\Form;

use App\Entity\CtArretePrix;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtArretePrixType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('artNumero')
            ->add('artDate')
            ->add('artDateApplic')
            ->add('artCreatedAt')
            ->add('artUpdatedAt')
            ->add('ctUser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtArretePrix::class,
        ]);
    }
}
