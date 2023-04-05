<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('firstname', TextType::class, [
            'label' => 'Prénom',
            'constraints'=> new Length([
                'min'=> 2,
                'max'=> 30
        ]), //Longueur de 2 min à 30 caractères Max
            'attr' => [
                'placeholder' => 'Veuillez saisir votre prénom'
            ]
        ])
        
        ->add('lastname', TextType::class, [
            'label' => 'Nom',
            'constraints'=> new Length([
                'min'=> 2,
                'max'=> 30
        ]), //Longueur de 2 min à 30 caractères Max
            'attr' => [
                'placeholder' => 'Veuillez saisir votre nom'
            ]
        ])
            ->add('email', EmailType::class,)

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passes ne sont pas identique.',
                'label' => 'Votre mot de passe',
                'required' => true,
                'constraints'=> new Length([
                    'min'=> 2,
                    'max'=> 50
            ]), //Longueur de 2 min à 50 caractères Max
                'first_options'=> [
                    'label' => 'Mot de passe',
                    'attr'=> [
                        'placeholder' => 'Veuillez de saisir votre mot de passe'
                    ]
                ],
                'second_options'=>[
                    'label'=> 'Confirmer votre mot de passe',
                    'attr'=> [
                        'placeholder' => 'Veuillez de confirmer votre mot de passe'
                    ]
                    ]
            ])

            ->add('guestsNumber', IntegerType::class, [
                'label' => 'Nombre de convives par defaut',
                'attr' => [
                    'placeholder' => '',
                    'min' => 0, //  empêcher les valeurs négatives
                ],
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 0,
                        'message' => 'Le nombre de convives ne peut pas être inférieur à 0.'
                    ])
                ]
            ])

            ->add('allergies', TextType::class, [
                'label' => 'Des allergies eventuelles ?',
                'attr' => [
                    'placeholder' => ''
                ]
            ])

                        ->add('agreeTerms', CheckboxType::class, [
                            'label' => 'Vous acceptez les termes et conditions d\'utilisation de notre site.',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez confirmer les termes.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
