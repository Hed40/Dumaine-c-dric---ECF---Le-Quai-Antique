<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\RestaurantScheduleRepository;
use App\Security\UsersAuthentificatorAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UsersAuthentificatorAuthenticator $authenticator, EntityManagerInterface $entityManager,RestaurantScheduleRepository $restaurantScheduleRepository): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $restaurantSchedules = $restaurantScheduleRepository->findAll();
        // Récupére les horaires de restaurant
        // passe la variable $restaurantSchedules à la vue

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            $userAuthenticator->authenticateUser(
            $user,
            $authenticator,
            $request
              
            );

            return  $this->redirectToRoute('registration_success');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'restaurantSchedules' => $restaurantSchedules
        ]);
    }

    #[Route('/registration/success', name: 'registration_success')]
    public function success(RestaurantScheduleRepository $restaurantScheduleRepository): Response
    {
        $restaurantSchedules = $restaurantScheduleRepository->findAll();
        // Affichage de la page de succès de la registration
        return $this->render('registration/success.html.twig', [
            'restaurantSchedules' => $restaurantSchedules
        ]);
    }
}
