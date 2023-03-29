<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantScheduleController extends AbstractController
{
    #[Route('/register', name: 'app_restaurant_schedule')]
    public function index(): Response
    {
        return $this->render('', [
            'restaurantSchedules' => 'RestaurantScheduleController',
        ]);
    }
}
