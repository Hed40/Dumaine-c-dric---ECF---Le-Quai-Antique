<?php

namespace App\Controller\Admin;

use App\Entity\Restaurant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Restaurant::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('Name','Nom du restaurant'),
            TextField::new('adresse','Adresse du restaurant'),
            TextField::new('phoneNumber','Numéro de téléphone'),
            EmailField::new('email','Adresse email'),
            IntegerField::new('maxSeats','Nombre de places maximum'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Gérer les informations de vos restaurants')
            ->setPageTitle('new', 'Ajouter les informations de votre restaurant')
            ->setPageTitle('edit', 'Modifier les informations de votre restaurant')
            ->setPageTitle('detail', 'Détails des informations de votre restaurant');
    }
}
