<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            'label' => 'Votre nom',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Votre nom ici'
            ]
        ])
        ->add('Lastname', TextType::class, [
            'label' => 'Votre prénom',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Votre prénom ici'
            ]
        ])
        ->add('phone_number', TextType::class, [
            'label' => 'N° de téléphone',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'N° de téléphone'
            ]
        ])
        ->add('nombreCouverts', IntegerType::class, [
            'label' => 'Nombre de couverts',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Nombre de couverts'
            ],
            'constraints' => [
                new GreaterThanOrEqual([
                    'value' => 1,
                    'message' => 'Vous devez réserver au moins 1 couvert.',
                ]),
            ],
        ])
        
            ->add('date', DateType::class, [
                'label' => 'Date de réservation',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                    'id' =>'date',
                    'placeholder' => 'jj/mm/aaaa',
                ],
                'constraints' => [
                    new NotTheSunday(),
                ],
            ])
            ->add('heure', ChoiceType::class, [
                'label' => "Heure prévue d'arrivée",
                'attr' => [
                    'class' => 'form-control',
                    'id' =>'heure',
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
                    '15h00' => '14:00:00',
                ],
            ])
            ->add('allergie', TextareaType::class, [
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
