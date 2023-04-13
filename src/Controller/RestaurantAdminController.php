<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantAdminController extends AbstractController
{
    #[Route('/restaurant/admin', name: 'app_restaurant_admin')]
    public function index(): Response
    {
        return $this->render('restaurant_admin/index.html.twig', [
            'controller_name' => 'RestaurantAdminController',
        ]);
    }
}
