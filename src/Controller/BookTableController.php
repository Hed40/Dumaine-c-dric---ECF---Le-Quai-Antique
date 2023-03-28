<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookTableController extends AbstractController
{
    #[Route('/booktable', name: 'app_booktable')]
    public function index(): Response
    {
        return $this->render('booktable/index.html.twig', [
            'controller_name' => 'BookTableController',
        ]);
    }
}
