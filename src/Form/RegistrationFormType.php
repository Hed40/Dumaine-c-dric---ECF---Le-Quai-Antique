<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]), //Longueur de 2 min à 30 caractères Max
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre prénom'
                ]
            ])

            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]), //Longueur de 2 min à 30 caractères Max
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre adresse email'
                ]
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passes ne sont pas identique.',
                'label' => 'Votre mot de passe',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Veuillez saisir votre mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmer votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Veuillez confirmer votre mot de passe'
                    ]
                ],
                'constraints' => ([
                    new Length([
                        'min' => 8,
                        'max' => 50,
                        //Longueur de 8 min à 50 caractères Max
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Votre mot de passe doit contenir au maximum {{ limit }} caractères.',
                    ]),
                    // expression regulière regex pour le mot de passe
                    new Regex([
                        'pattern' => '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
                        'message' => 'Votre mot de passe doit contenir au moins un chiffre, une lettre, un caractère spécial (@$!%*#?&) et avoir au moins 8 caractères.'
                    ]),
                ])
            ])

            ->add('guestsNumber', IntegerType::class, [
                'label' => 'Nombre de couverts par defaut',
                'attr' => [
                    'placeholder' => 'Nombre de couverts par defaut',
                    'min' => 0, //  empêcher les valeurs négatives
                ],
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 1,
                        'message' => 'Le nombre de convives ne peut pas être inférieur à 1.',
                    ])
                ]
            ])

            ->add('allergie', TextType::class, [
                'label' => 'Des allergies eventuelles ?',
                'attr' => [
                    'placeholder' => 'Exemple : Lactoze, Gluten, etc...',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
