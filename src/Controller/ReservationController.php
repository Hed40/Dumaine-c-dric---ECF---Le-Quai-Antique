<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationFormType;
use App\Repository\RestaurantRepository;
use App\Repository\RestaurantScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(Request $request, EntityManagerInterface $entityManager, RestaurantScheduleRepository $restaurantScheduleRepository): Response
    {
        // Récupérez les horaires des restaurants ici
        $restaurantSchedules = $restaurantScheduleRepository->findAll();
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
            return $this->redirectToRoute('app_reservation');
        }

        // Affichage de la page de réservation avec le formulaire
        return $this->render('reservation/index.html.twig', [
            'form' => $form->createView(),
            'restaurantSchedules' => $restaurantSchedules,
        ]);
    }

    /* #[Route('/reservation/success', name: 'reservation_success')]
    public function success(RestaurantScheduleRepository $restaurantScheduleRepository): Response
    {
        $restaurantSchedules = $restaurantScheduleRepository->findAll();
        // Affichage de la page de succès de la réservation
        return $this->render('reservation/success.html.twig', [
            'restaurantSchedules' => $restaurantSchedules
        ]);
    }*/

    // Crée une route pour accéder à cette fonction
    #[Route('/reservation/gettimeslots', name: 'get_time_slots', methods: ['GET', 'POST'])]
    public function checkAvaibality(Request $request, RestaurantRepository $restaurantRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        // Récupère les informations du formulaire
        $nombreDeCouverts = $request->request->get('guestsNumber');
        $requestDate = $request->request->get('date');
        $requestHeure = $request->request->get('heure');

        // Tente de convertir les dates et heures en objets DateTime
        try {
            $currentDate = new \DateTime($requestDate);
            $heure = new \DateTime($requestHeure);
        } catch (\Exception $e) {
            // Si la conversion échoue, retourne une erreur
            return new JsonResponse(['error' => 'Invalid date or time']);
        }

        // Récupère les informations du restaurant
        $restaurant = $restaurantRepository->find(1);
        $maxSeats = $restaurant->getMaxSeats();


        // Parcours les 7 prochains jours
        for ($day = 0; $day < 1; $day++) {
            // Calcule la date du jour courant
            $currentDateForDay = clone $currentDate;
            $currentDateForDay->modify("+$day day");

            // Parcours les heures de chaque journée (ici de 12h à 14h)
            for ($i = 12; $i <= 14; $i++) {
                // Initialise une variable $j pour les minutes, qui commence à 0
                $j = 0;
                // Utilise une boucle 'while' pour parcourir les minutes tant que $j est inférieur à 60
                while ($j < 60) {
                    // Si l'heure est 14h00 et les minutes supérieures à 0, arrêtez la boucle
                    if ($i == 14 && $j > 0) {
                        break;
                    }

                    // Crée une chaîne de caractères pour l'heure et les minutes en utilisant sprintf()
                    // pour formater les nombres avec deux chiffres (par exemple, '12:00')
                    $heureString = sprintf('%02d:%02d', $i, $j);

                    $dateTime = new \DateTime($currentDateForDay->format('Y-m-d') . " $heureString");
                    $totalReservedSeats = $this->getTotalReservedSeats($entityManager, $dateTime->format('Y-m-d'), $dateTime->format('H:i:s'));
                    $isAvailable = ($maxSeats - $totalReservedSeats) >= $nombreDeCouverts;

                    // Si le nombre de places est égal à 0, alors il n'y a plus de disponibilité
                    $place = $maxSeats - $totalReservedSeats;
                    if ($place == 0) {
                        $isAvailable = false;
                    }

                    // Ajoute le créneau horaire à la liste avec ses informations
                    $timeSlots[] = [
                        'heure' => $heureString,
                        'isAvailable' => $isAvailable,
                        'date' => $dateTime->format('d-m-y'),
                        'places' => $place,
                    ];

                    // Incrémente $j de 15 à chaque itération pour passer au prochain créneau de 15 minutes
                    $j += 15;
                }
            }
        }
   
        for ($day = 0; $day < 1; $day++) {
            // Calcule la date du jour courant
            $currentDateForDay = clone $currentDate;
            $currentDateForDay->modify("+$day day");

            // Parcours les heures de chaque journée (ici de 18h à 22h)
            for ($i = 18; $i <= 21; $i++) {
                // Initialise une variable $j pour les minutes, qui commence à 0
                $j = 0;
                // Utilise une boucle 'while' pour parcourir les minutes tant que $j est inférieur à 60
                while ($j < 60) {
                    // Si l'heure est 14h00 et les minutes supérieures à 0, arrêtez la boucle
                    if ($i == 21 && $j > 0) {
                        break;
                    }

                    // Crée une chaîne de caractères pour l'heure et les minutes en utilisant sprintf()
                    // pour formater les nombres avec deux chiffres (par exemple, '12:00')
                    $heureString = sprintf('%02d:%02d', $i, $j);

                    $dateTime = new \DateTime($currentDateForDay->format('Y-m-d') . " $heureString");
                    $totalReservedSeats = $this->getTotalReservedSeats($entityManager, $dateTime->format('Y-m-d'), $dateTime->format('H:i:s'));
                    $isAvailable = ($maxSeats - $totalReservedSeats) >= $nombreDeCouverts;

                    // Si le nombre de places est égal à 0, alors il n'y a plus de disponibilité
                    $place = $maxSeats - $totalReservedSeats;
                    if ($place == 0) {
                        $isAvailable = false;
                    }

                    // Ajoute le créneau horaire à la liste avec ses informations
                    $timeSlots2[] = [
                        'heure' => $heureString,
                        'isAvailable' => $isAvailable,
                        'date' => $dateTime->format('d-m-y'),
                        'places' => $place,
                    ];

                    // Incrémente $j de 15 à chaque itération pour passer au prochain créneau de 15 minutes
                    $j += 15;
                }
            }
        }

        // Retourne la liste des créneaux horaires
        return new JsonResponse([
            'slot' => $timeSlots,
            'slot2' => $timeSlots2
        ]);
    }


    private function getTotalReservedSeats(EntityManagerInterface $entityManager, string $date, string $heure): int
    {
        $repository = $entityManager->getRepository(Reservation::class);
        $totalReservedSeats = $repository->createQueryBuilder('r')
            ->select('SUM(r.guestsNumber) as total')
            ->where('r.date = :date')
            ->andWhere('r.heure = :heure')
            ->setParameter('date', $date)
            ->setParameter('heure', $heure)
            ->getQuery()
            ->getSingleScalarResult();

        return (int)$totalReservedSeats;
    }
}
