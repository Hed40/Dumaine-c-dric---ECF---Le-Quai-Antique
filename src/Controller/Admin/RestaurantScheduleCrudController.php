<?php

namespace App\Controller\Admin;

use App\Entity\RestaurantSchedule;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class RestaurantScheduleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RestaurantSchedule::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('weekday', 'Jour de la semaine'),
            TimeField::new('lunchOpeningTime', 'Heure d\'ouverture du midi'),
            TimeField::new('lunchClosureTime', 'Heure de fermeture du midi'),
            TimeField::new('eveningOpeningTime', 'Heure d\'ouverture du soir'),
            TimeField::new('eveningClosureTime', 'Heure de fermeture du soir'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Gérer les horaires du restaurant')
            ->setPageTitle('new', 'Ajouter un horaire')
            ->setPageTitle('edit', 'Modifier un horaire')
            ->setPageTitle('detail', 'Détails de l\'horaire');
    }
}
