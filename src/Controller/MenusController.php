<?php

namespace App\Controller;

use App\Repository\MenusRepository;
use App\Repository\RestaurantScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenusController extends AbstractController
{
    #[Route('/menus', name: 'app_menus')]
    public function index(RestaurantScheduleRepository $restaurantScheduleRepository, MenusRepository $MenusRepository): Response
    {
        $restaurantSchedules = $restaurantScheduleRepository->findAll();
        $menus = $MenusRepository->findAll();

        return $this->render('menus/index.html.twig', [ 
            'restaurantSchedules' => $restaurantSchedules,
            'menus' => $menus
        ]); 
    }
}

