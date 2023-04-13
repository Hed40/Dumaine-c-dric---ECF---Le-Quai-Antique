<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationFormType;
use App\Repository\ReservationRepository;
use App\Repository\RestaurantScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AccountController extends AbstractController
{
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->currentUser = $tokenStorage->getToken()->getUser();
    }
    #[Route('/account', name: 'app_account', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager, RestaurantScheduleRepository $restaurantScheduleRepository, ReservationRepository $reservationRepository): Response
    {
        // Récupére les horaires de restaurant
        $restaurantSchedules = $restaurantScheduleRepository->findAll();
        // Récupère les réservations de l'utilisateur
        $userReservation =  $reservationRepository->findBy(['reservationUser' => $this->currentUser]);
        // Instanciation d'un nouvel objet Reservation
        $reservation = new Reservation();
        // Création d'un formulaire de type ReservationFormType
        $form = $this->createForm(ReservationFormType::class, $reservation);
        $form->get('Firstname')->setData($this->currentUser->getFirstName());
        $form->get('Lastname')->setData($this->currentUser->getLastName());
        $form->get('guestsNumber')->setData($this->currentUser->getGuestsNumber());
        $form->get('allergie')->setData($this->currentUser->getAllergie());

        // si le formulaire a été soumis
        $form->handleRequest($request);
        // Vérification si le formulaire est valide et envoi des données dans la
        // base de données
        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setReservationUser($this->currentUser);
            $reservationRepository->save($reservation, true);
            $entityManager->persist($reservation);
            $entityManager->flush();
            return $this->redirectToRoute('app_account', [], Response::HTTP_SEE_OTHER);
        }
        // Rendu de la vue avec le formulaire
        return $this->render('account/index.html.twig', [
            'form' => $form->createView(),
            'restaurantSchedules' => $restaurantSchedules,
            'userReservation' => $userReservation,
        ]);
    }
}
