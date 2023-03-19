<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenusController extends AbstractController
{
    #[Route('/menus', name: 'app_menus')]
    public function index(): Response
    {
        $menus = array('menu1', 'menu2', 'menu3'); // Définition de la variable "menus"
        return $this->render('menus/index.html.twig', ['menus' => $menus]); // Passage de la variable "menus" au template Twig
    }
}
