<?php

namespace App\Controller;

use App\Repository\RestaurantScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenusController extends AbstractController
{
    #[Route('/menus', name: 'app_menus')]
    public function index(RestaurantScheduleRepository $restaurantScheduleRepository): Response
    {
        $restaurantSchedules = $restaurantScheduleRepository->findAll();
        return $this->render('menus/index.html.twig', [ 
            'restaurantSchedules' => $restaurantSchedules]); 
    }
}
