<?php

namespace App\Controller\Admin;

use App\Entity\Dish;
use App\Repository\CategoriesRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class DishCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dish::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            // Champ de texte simple pour le titre du plat
            TextEditorField::new('description'),
            // Champ de texte enrichi pour la description du plat
            AssociationField::new('categorie', 'Catégories')
                // Champ d'association pour la catégorie du plat
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
                    return $entity->getCategorie()->getName();
                }),
            // On affiche le nom des catégories dans le choix
            MoneyField::new('price', 'Prix')
                // Champ de monnaie pour le prix du plat
                ->setCurrency('EUR')
                // Devise de l'argent
                ->setStoredAsCents(false),
            // On stocke le prix en euros et centimes, mais on l'affiche en euros et décimales
        ];
    }
}
