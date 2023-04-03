<?php

namespace App\Controller\Admin;

use App\Entity\Desserts;
use App\Repository\CategoriesRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DessertsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Desserts::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom du dessert'),
        // Champ de texte enrichi pour la description de la boisson
        AssociationField::new('type', 'Catégorie')
            // Champ d'association pour la catégorie
            ->setRequired(true)
            // La catégorie est obligatoire
            ->setFormTypeOption('query_builder', function (
                CategoriesRepository $categoriesRepository
            ) {
                return $categoriesRepository
                    ->createQueryBuilder('c')
                    // On récupère les catégories
                    ->orderBy('c.name', 'ASC');
                // On les trie par ordre alphabétique
            })
            ->setFormTypeOption('choice_label', 'name')
            //L'ajout de la méthode formatValue permet de récupérer le nom de la catégorie sélectionnée au lieu de son ID.
            ->formatValue(function ($value, $entity) {
                return $entity->gettype()->getName();
            }),
            TextEditorField::new('description'),
            TextField::new('allergene', 'Allergenes éventuels'),
            MoneyField::new('price', 'Prix')
            // Champ de monnaie pour le prix de la boisson
            ->setCurrency('EUR')
            // Devise de l'argent
            ->setStoredAsCents(false),
        // On stocke le prix en euros et centimes, mais on l'affiche en euros et décimales
        ];
    }
}
