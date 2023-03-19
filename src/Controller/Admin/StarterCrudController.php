<?php

namespace App\Controller\Admin;

use App\Entity\Starter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StarterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Starter::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
}
