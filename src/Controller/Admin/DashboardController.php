<?php

namespace App\Controller\Admin;

use App\Entity\Restaurant;
use App\Entity\Reservation;
use App\Entity\Categories;
use App\Entity\Dish;
use App\Entity\Drinks;
use App\Entity\Menus;
use App\Entity\SetMenu;
use App\Entity\Desserts;
use App\Entity\Gallery;
use App\Entity\RestaurantSchedule;
use App\Entity\Starter;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Le Quai Antique - Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::submenu("GESTION DES UTILISATEURS", "fa fa-users")->setSubItems([
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class)
        ]);

        yield MenuItem::submenu("GESTION DU RESTAURANT", "fa fa-clock-o")->setSubItems([
            MenuItem::linkToCrud('Horaires', 'fa fa-clock-o', RestaurantSchedule::class),
            MenuItem::linkToCrud('Réservations', 'fa fa-check-square-o', Reservation::class),
            MenuItem::linkToCrud('Nombre de places', 'fa fa-check-square-o', Restaurant::class),
        ]);

        yield MenuItem::subMenu('GESTION DE LA CARTE DU RESTAURANT', 'fa fa-cutlery')->setSubItems([
            MenuItem::linkToCrud('Entrées', 'fa fa-cutlery', Starter::class),
            MenuItem::linkToCrud('Plats', 'fa fa-cutlery', Dish::class),
            MenuItem::linkToCrud('Desserts', 'fa fa-cutlery', Desserts::class),
            MenuItem::linkToCrud('Boissons', 'fa fa-glass', Drinks::class),
            MenuItem::linkToCrud('Menus', 'fa fa-cutlery', Menus::class),
            MenuItem::linkToCrud('Formules', 'fa fa-cutlery', SetMenu::class),
            MenuItem::linkToCrud('Catégories de Produits', 'fa fa-product', Categories::class),
        ]);
        yield MenuItem::subMenu('GESTION DES GALERIES','fa fa-picture-o')->setSubItems([
            MenuItem::linkToCrud("Galerie d'image - Accueil", 'fa fa-picture-o', Gallery::class),
        ]);
    }
}
