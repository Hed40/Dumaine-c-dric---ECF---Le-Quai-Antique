<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Firstname','Prénom'), 
            TextField::new('Lastname','Nom'),
            TextField::new('phone_number','Numéro de téléphone'),
            TextField::new('allergie','Allergies'),
            DateField::new('date','Date de réservation'),
            TextField::new('heure','Heure de réservation'),
            IntegerField::new('guestsNumber','Nombre de couverts'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Gérer vos réservations')
            ->setPageTitle('new', 'Ajouter une réservation')
            ->setPageTitle('edit', 'Modifier une réservation')
            ->setPageTitle('detail', 'Détails de vos réservations');
    }

}
