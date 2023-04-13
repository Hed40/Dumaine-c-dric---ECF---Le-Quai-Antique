<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;


class NotTheSunday extends Constraint
{
    public $message ='Le restaurant est fermé le dimanche.';

    public function validedBy()
    {
        return NotTheSundayValidator::class;
    }
}
    class NotTheSundayValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$value instanceof \DateTimeInterface) {
            throw new UnexpectedTypeException($value, \DateTimeInterface::class);
        }
    
        if ($value->format('N') == 7) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}

class ReservationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Firstname', TextType::class, [
            'label' => 'Votre prénom',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Veuillez saisir votre prénom'
            ]
        ])
        ->add('Lastname', TextType::class, [
            'label' => 'Votre nom',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Veuillez saisir votre nom'
            ]
        ])
        ->add('phone_number', TextType::class, [
            'label' => 'N° de téléphone',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'N° de téléphone'
            ]
        ])
        ->add('guestsNumber', IntegerType::class, [
            'label' => 'Nombre de couverts',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Indiquez le nombre de couverts',
                'min' => 1, //  empêcher les valeurs négatives
                'max' => 12, //  empêcher les réservations au dessus de 12 personnes
                'value' => 1, //  définir la valeur par défaut à 1
            ],
            'constraints' => [
                new GreaterThanOrEqual([
                    'value' => 1,
                    'message' => 'Le nombre de convives ne peut pas être inférieur à 1.',
                ]),
            ],
        ])
            ->add('date', DateType::class, [
                'label' => 'Date de réservation',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'jj/mm/aaaa',
                ],
                'constraints' => [
                    new NotTheSunday(),
                ],

                'data' => new \DateTime('now'), //  définir la date par défaut sur la date d'aujourd'hui
            ])
            ->add('heure', ChoiceType::class, [
                'label' => "Heure prévue d'arrivée",
                'attr' => [
                    'class' => 'form-control',
                ],
                'choices' => [
                    '12h00' => '12:00:00',
                    '12h15' => '12:15:00',
                    '12h30' => '12:30:00',
                    '12h45' => '12:45:00',
                    '13h00' => '13:00:00',
                    '13h15' => '13:15:00',
                    '13h30' => '13:30:00',
                    '13h45' => '13:45:00',
                    '14h00' => '14:00:00',
                    '18h00' => '18:00:00',
                    '18h15' => '18:15:00',
                    '18h30' => '18:30:00',
                    '18h45' => '18:45:00',
                    '19h00' => '19:00:00',
                    '19h15' => '19:15:00',
                    '19h30' => '19:30:00',
                    '19h45' => '19:45:00',
                    '20h00' => '20:00:00',
                    '20h15' => '20:15:00',
                    '20h30' => '20:30:00',
                    '20h45' => '20:45:00',
                    '21h00' => '21:00:00',
                ],
                'group_by' => function($value) {
                    if ($value >= '12:00:00' && $value <= '14:00:00') {
                        return 'Réserver pour le diner';
                    } elseif ($value >= '18:00:00' && $value <= '21:00:00') {
                        return 'Réserver pour le déjeuner';
                    }
                },
            ])
            ->add('allergie', TextType::class, [
                'label' => 'Allergies éventuelles',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Allergies éventuelles'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
