<?php

namespace App\Form;

use App\Entity\CtUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtAffectationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, [
                'label' => 'Nom utilisateur',
                'disabled' => 'True',
            ])
            //->add('usernameCanonical')
            ->add('email', null, [
                'label' => 'mail',
                'disabled' => 'True',
            ])
            //->add('emailCanonical')
            //->add('enabled')
            //->add('salt')
            //->add('password')
            //->add('lastLogin')
            //->add('confirmationToken')
            //->add('passwordRequestedAt')
            //->add('roles')
            ->add('usrName', null, [
                'label' => 'Nom et prénom',
                'disabled' => 'True',
            ])
            //->add('usrEmail')
            //->add('usrLocked')
            //->add('usrPassword')
            //->add('usrAdresse')
            //->add('usrToken')
            //->add('usrCreatedAt')
            //->add('usrUpdatedAt')
            //->add('usrLockedUpdate')
            //->add('usrRequestUpdate')
            //->add('usrProfession')
            //->add('usrTelephone')
            //->add('usrIsConnected')
            //->add('usrPresence')
            ->add('ctRole', null, [
                'label' => 'Rôle',
                'disabled' => 'True',
            ])
            ->add('ctCentre', null, [
                'attr' => [
                    'class' => 'js-example-basic-multiple',
                ]
            ])
            //->add('ctRole')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CtUser::class,
        ]);
    }
}
