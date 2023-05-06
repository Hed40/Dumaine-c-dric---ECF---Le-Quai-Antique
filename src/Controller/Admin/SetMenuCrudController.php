<?php

namespace App\Controller\Admin;

use App\Entity\SetMenu;
use App\Repository\DessertsRepository;
use App\Repository\DishRepository;
use App\Repository\StarterRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SetMenuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SetMenu::class;
    }
public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom de la formule'),
            TextEditorField::new('description','Description de la formule'),
            AssociationField::new('starter', "Choix de l'entrée")
            // Champ d'association pour la catégorie
            ->setRequired(true)
            // La catégorie est obligatoire
            ->setFormTypeOption('query_builder', function (
                StarterRepository $starterRepository
            ) {
                return $starterRepository
                    ->createQueryBuilder('c')
                    // On récupère les catégories
                    ->orderBy('c.title', 'ASC');
                // On les trie par ordre alphabétique
            })
            ->setFormTypeOption('choice_label', 'title')
            //L'ajout de la méthode formatValue permet de récupérer le nom de la catégorie sélectionnée au lieu de son ID.
            ->formatValue(function ($value, $entity) {
                return $entity->getStarter() ? $entity->getStarter()->getTitle(): ''; // Si la valeur est null alors ca affichera vide
            }),
            AssociationField::new('Dish', "Choix du plat")
            // Champ d'association pour la catégorie
            ->setRequired(true)
            // La catégorie est obligatoire
            ->setFormTypeOption('query_builder', function (
                DishRepository $DishRepository
            ) {
                return $DishRepository
                    ->createQueryBuilder('c')
                    // On récupère les catégories
                    ->orderBy('c.title', 'ASC');
                // On les trie par ordre alphabétique
            })
            ->setFormTypeOption('choice_label', 'title')
            //L'ajout de la méthode formatValue permet de récupérer le nom de la catégorie sélectionnée au lieu de son ID.
            ->formatValue(function ($value, $entity) {
                return $entity->getDish() ? $entity->getDish()->getTitle(): ''; // Si la valeur est null alors ca affichera vide
            }),
            AssociationField::new('Dessert', "Choix du dessert")
            // Champ d'association pour la catégorie
            ->setRequired(true)
            // La catégorie est obligatoire
            ->setFormTypeOption('query_builder', function (
                DessertsRepository $DessertsRepository
            ) {
                return $DessertsRepository
                    ->createQueryBuilder('c')
                    // On récupère les catégories
                    ->orderBy('c.name', 'ASC');
                // On les trie par ordre alphabétique
            })
            ->setFormTypeOption('choice_label', 'name')
            //L'ajout de la méthode formatValue permet de récupérer le nom de la catégorie sélectionnée au lieu de son ID.
            ->formatValue(function ($value, $entity) {
                return $entity->getDessert() ? $entity->getDessert()->getName(): ''; // Si la valeur est null alors ca affichera vide
            }),
            MoneyField::new('price', 'Prix')
            // Champ de monnaie pour le prix du dessert
            ->setCurrency('EUR')
            // Devise de l'argent
            ->setStoredAsCents(false),
        // On stocke le prix en euros et centimes, mais on l'affiche en euros et décimales        
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Gérer vos formules')
            ->setPageTitle('new', 'Ajouter une formule')
            ->setPageTitle('edit', 'Modifier une formule')
            ->setPageTitle('detail', 'Détails de la formule');
    }
}
