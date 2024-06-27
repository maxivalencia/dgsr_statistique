<?php

namespace App\Form;

use App\Entity\CtTarifAutreService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtTarifAutreServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tasTarif')
            ->add('ctArretePrix')
            ->add('ctTypeAutreSce')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtTarifAutreService::class,
        ]);
    }
}
