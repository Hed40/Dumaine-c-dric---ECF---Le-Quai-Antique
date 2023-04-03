<?php

namespace App\Controller;

use App\Repository\RestaurantScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, RestaurantScheduleRepository $restaurantScheduleRepository): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $restaurantSchedules = $restaurantScheduleRepository->findAll();
        // Récupére les horaires de restaurant
        // passe la variable $restaurantSchedules à la vue

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 'error' => $error,
            'restaurantSchedules' => $restaurantSchedules
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
