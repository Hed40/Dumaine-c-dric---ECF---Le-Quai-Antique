<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GalleryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gallery::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        //  On surcharge la méthode configureFields pour personnaliser les champs de l'interface d'administration
        return [
            TextField::new('Titre'),
            ImageField::new('illustration') 
            ->setBasePath('uploads/images/gallery/')
            // On indique le chemin vers le dossier public
            ->setUploadDir('public/uploads/images/gallery')
            // On indique le chemin vers le dossier public
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            // On génère un nom de fichier aléatoire
            ->setRequired(false)
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Gérer votre galerie')
            ->setPageTitle('new', 'Ajouter une galerie')
            ->setPageTitle('edit', 'Modifier une galerie')
            ->setPageTitle('detail', 'Détails une galerie');
    }
}
