<?php

namespace App\Controller;

use App\Entity\Parcours;
use App\Form\ParcoursType;
use App\Repository\ParcoursRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



/**
 * @Route("/parcours/intervenants")
 */
class ParcoursIntervenantsController extends AbstractController
{

    /**
     * @Route("/", name="app_parcours_intervenants_index", methods={"GET"})
     */
    public function index(ParcoursRepository $parcoursRepository): Response
    {
        return $this->render('parcours_intervenants/index.html.twig', [
            'parcours' => $parcoursRepository->findAll(),
        ]);
    }


      /**
     * @Route("/new", name="app_parcours_intervenants_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ParcoursRepository $parcoursRepository): Response
    {
        $parcour = new Parcours();
        $form = $this->createForm(ParcoursType::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parcoursRepository->add($parcour, true);

            return $this->redirectToRoute('app_parcours_intervenants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcours_intervenants/new.html.twig', [
            'parcour' => $parcour,
            'form' => $form,
        ]);
    }

     /**
     * @Route("/{id}", name="app_parcours_intervenants_show", methods={"GET"})
     */
    public function show(Parcours $parcour): Response
    {
        return $this->render('parcours_intervenants/show.html.twig', [
            'parcour' => $parcour,
        ]);
    }



    /**
     * @Route("/{id}/edit", name="app_parcours_intervenants_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Parcours $parcour, ParcoursRepository $parcoursRepository): Response
    {
        $form = $this->createForm(ParcoursType::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parcoursRepository->add($parcour, true);

            return $this->redirectToRoute('app_parcours_intervenants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcours_intervenants/edit.html.twig', [
            'parcour' => $parcour,
            'form' => $form,
        ]);
    }


   /**
     * @Route("/{id}", name="app_parcours_intervenants_delete", methods={"POST"})
     */
    public function delete(Request $request, Parcours $parcour, ParcoursRepository $parcoursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parcour->getId(), $request->request->get('_token'))) {
            $parcoursRepository->remove($parcour, true);
        }

        return $this->redirectToRoute('app_parcours_intervenants_index', [], Response::HTTP_SEE_OTHER);
    }
}
