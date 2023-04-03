<?php

namespace App\Controller;

use App\Repository\RestaurantScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(RestaurantScheduleRepository $restaurantScheduleRepository): Response
    {
        $restaurantSchedules = $restaurantScheduleRepository->findAll();
        // Récupére les horaires de restaurant
        // passe la variable $restaurantSchedules à la vue
        return $this->render('account/index.html.twig', [
            'restaurantSchedules' => $restaurantSchedules,
        ]);
    }
}
