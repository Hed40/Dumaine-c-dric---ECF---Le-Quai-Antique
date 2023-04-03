<?php

namespace App\Controller;

use App\Repository\RestaurantScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(RestaurantScheduleRepository $restaurantScheduleRepository): Response
    {
        $restaurantSchedules = $restaurantScheduleRepository->findAll();
        // Récupére les horaires de restaurant
        // passe la variable $restaurantSchedules à la vue
        return $this->render('accueil/index.html.twig', [
            'restaurantSchedules' => $restaurantSchedules,
        ]);
    }
}
