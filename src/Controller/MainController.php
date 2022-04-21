<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


        /**
     * @Route("/gestion/calendrier", name="app_gestion_calendrier")
     */
    public function calendrier(): Response
    {
        return $this->render('main/gestion_calendrier.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
