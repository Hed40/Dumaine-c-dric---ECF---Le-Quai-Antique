<?php

namespace App\Controller\Admin;

use App\Entity\Menus;
use App\Repository\SetMenuRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MenusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Menus::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom du menu'),     
            AssociationField::new('LunchSetMenu', 'Formule du midi')
            // Champ d'association pour la catégorie du plat
            ->setRequired(true)
            // La catégorie est obligatoire
            ->setFormTypeOption('query_builder', function (
                SetMenuRepository $setMenuRepository
            ) {
                return $setMenuRepository
                    ->createQueryBuilder('c')
                    // On récupère les catégories
                    ->orderBy('c.name', 'ASC');
                // On les trie par ordre alphabétique
            })
            ->setFormTypeOption('choice_label', 'name')
            //L'ajout de la méthode formatValue permet de récupérer le nom de la catégorie sélectionnée au lieu de son ID.
            ->formatValue(function ($value, $entity) {
                return $entity->getLunchSetMenu()->getName();
            }),
        // On affiche le nom des catégories dans le choix
        AssociationField::new('DinerSetMenu', 'Formule du soir')
        // Champ d'association pour la catégorie du plat
        ->setRequired(true)
        // La catégorie est obligatoire
        ->setFormTypeOption('query_builder', function (
            SetMenuRepository $setMenuRepository
        ) {
            return $setMenuRepository
                ->createQueryBuilder('c')
                // On récupère les catégories
                ->orderBy('c.name', 'ASC');
            // On les trie par ordre alphabétique
        })
        ->setFormTypeOption('choice_label', 'name')
        //L'ajout de la méthode formatValue permet de récupérer le nom de la catégorie sélectionnée au lieu de son ID.
        ->formatValue(function ($value, $entity) {
            return $entity->getDinerSetMenu()->getName();
        }),
    // On affiche le nom des catégories dans le choix
        ];
    }
}
