<?php

namespace App\Controller\Admin;

use App\Entity\RestaurantSchedule;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RestaurantScheduleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RestaurantSchedule::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
