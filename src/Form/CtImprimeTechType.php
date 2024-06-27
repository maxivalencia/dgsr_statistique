<?php

namespace App\Form;

use App\Entity\CtImprimeTech;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtImprimeTechType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomImprimeTech')
            ->add('uteImprimeTech')
            ->add('abrevImprimeTech')
            ->add('prttCreatedAt')
            ->add('prttUpdatedAt')
            ->add('ctUser')
            ->add('ctAutreSce')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtImprimeTech::class,
        ]);
    }
}
