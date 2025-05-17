<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PasswordUserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'label' => 'Votre mot de passe actuel',
                'attr' => [
                    'placeholder' => 'indiquez votre mot de passe actuel'
                ],
                'mapped' => false,
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                    'label' => 'Votre nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Choisissez votre nouveau mot de passe'
                    ],
                    'hash_property_path' => 'password'
                ],
                'second_options' => [
                    'label' => 'Confirmez votre nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmez votre nouveau mot de passe'
                    ],
                ],
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Mettre à jour mon mot de passe'
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $from = $event->getForm();
                $user = $from->getConfig()->getOptions()['data'];
                $passwordHasher = $from->getConfig()->getOptions()['password_hasher'];

                $isValide = $passwordHasher->IsPasswordValid(
                    $user,
                    $from->get('currentPassword')->getData()
                );
                if (!$isValide) {
                    $from->get('currentPassword')->addError(new FormError("Votre mot de passe actuel est incorrect. Veuiller vérifier votre saisie."));
                }
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'password_hasher' => null,
        ]);
    }
}
