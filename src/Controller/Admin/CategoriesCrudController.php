<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categories::class;
    }

    // Permet de modifier les champs de l'interface d'administration
    public function configureFields(string $pageName): iterable
    {
        return [
           TextField::new('name', 'Nom de la catégorie'),
        ];
    }

    // Permet de modifier le titre des pages de l'interface d'administration
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Gérer vos catégories de produits')
            ->setPageTitle('new', 'Ajouter une catégorie')
            ->setPageTitle('edit', 'Modifier une catégorie')
            ->setPageTitle('detail', 'Détails de la catégorie');
    }
}
