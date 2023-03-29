<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ReservationController extends AbstractController
{

    #[Route('/reservation', name: 'app_reservation')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Instanciation d'un nouvel objet Reservation
        $reservation = new Reservation();
        // Création d'un formulaire de type ReservationFormType
        $form = $this->createForm(ReservationFormType::class, $reservation);
        
        // Récupération des données du formulaire envoyé par POST et vérification
        // si le formulaire a été soumis
        $form->handleRequest($request);
        
        // Vérification si le formulaire est valide et envoi des données dans la
        // base de données
        if ($form->isSubmitted() && $form->isValid()) {
            // Persistance de l'objet Reservation
            $entityManager->persist($reservation);
            
            // Envoi des données dans la base de données
            $entityManager->flush();
            
            // Redirection vers la page de succès de la réservation
            //return $this->redirectToRoute('reservation_dispo');
        }
        
        // Affichage de la page de réservation avec le formulaire
        return $this->render('reservation/index.html.twig', [
            'form' => $form->createView(),
            'restaurantSchedules' => 'FooterController'
        ]);
        
    }
    
    #[Route('/reservation/success', name: 'reservation_success')]
    public function success(): Response
    {
        // Affichage de la page de succès de la réservation
        return $this->render('reservation/success.html.twig');
    }
    
    #[Route('/reservation', name: 'reservation')]
    public function available(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupération de la date et de l'heure envoyées en AJAX
        $date = $request->request->get('date');
        $heure = $request->request->get('heure');
        
        // Récupération de la réservation en base de données correspondant à la date
        // et l'heure envoyées en AJAX
        $repository = $entityManager->getRepository(Reservation::class);
        $reservation = $repository->findOneBy(['date' => $date, 'heure' => $heure]);
        
        // Si la réservation existe, retourner un message indiquant que le créneau est occupé
        if ($reservation) {
            return new JsonResponse(['#availability' => 'table NOT available'], Response::HTTP_CONFLICT);
        }
        // Si la réservation n'existe pas, retourner un message indiquant que le créneau est disponible
        return new JsonResponse(['#availability' => 'table available'], Response::HTTP_OK);
    }
}
