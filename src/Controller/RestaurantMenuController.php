<?php

namespace App\Controller;

use App\Repository\DishRepository;
use App\Repository\DrinksRepository;
use App\Repository\StarterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\RestaurantScheduleRepository;
use App\Repository\SetMenuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantMenuController extends AbstractController
{
    #[Route('/restaurant/menu', name: 'app_restaurant_menu')]
    public function index(RestaurantScheduleRepository $restaurantScheduleRepository, 
    StarterRepository $StarterRepository, SetMenuRepository $SetMenuRepository, DishRepository $SetDishRepository): Response
    {
        // Récupérez les horaires des restaurants ici
        $restaurantSchedules = $restaurantScheduleRepository->findAll();
        $starters = $StarterRepository->findAll();
        $setMenu = $SetMenuRepository->findAll();
        $dish = $SetDishRepository->findAll();

        return $this->render('restaurant_menu/index.html.twig', [
            'restaurantSchedules' => $restaurantSchedules,
            'starters' => $starters,
            'setMenu' => $setMenu,
            'dish' => $dish,
        ]);
    }
}
