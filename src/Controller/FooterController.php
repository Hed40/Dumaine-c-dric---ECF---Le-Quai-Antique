<?php

namespace App\Controller;

use App\Repository\RestaurantScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FooterController extends AbstractController
{
    public function index(restaurantScheduleRepository $restaurantScheduleRepository): Response
    {
        // Récupére les horaires de restaurant
        // passe la variable $restaurantSchedules à la vue
        $restaurantSchedules = $restaurantScheduleRepository->findAll();
        return $this->render('footer/index.html.twig', [
            'restaurantSchedules' => $restaurantSchedules,
        ]);
    }

}
