<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ParcoursApprenantController extends AbstractController
{
     /**
     * @Route("/parcours/apprenant", name="app_parcours_apprenant")
     */
    public function index(): Response
    {
        return $this->render('parcours_apprenant/index.html.twig', [
            'controller_name' => 'ParcoursApprenantController',
        ]);
    }
}
