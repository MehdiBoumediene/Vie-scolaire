<?php

namespace App\Controller;

use App\Entity\Parcours;
use App\Form\ParcoursType;
use App\Repository\ParcoursRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ParcoursApprenantController extends AbstractController
{
     /**
     * @Route("/parcours/apprenant", name="app_parcours_apprenant")
     */
    public function index(ParcoursRepository $parcoursRepository): Response
    {
        return $this->render('parcours_apprenant/index.html.twig', [
            'parcours' => $parcoursRepository->findAll(),
        ]);
    }
      /**
     * @Route("/parcours/apprenant/new", name="app_parcours_apprenant_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ParcoursRepository $parcoursRepository): Response
    {
        $parcour = new Parcours();
        $form = $this->createForm(ParcoursType::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parcoursRepository->add($parcour, true);

            return $this->redirectToRoute('app_parcours_apprenant', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('parcours_apprenant/new.html.twig', [
            'parcour' => $parcour,
            'form' => $form,
        ]);
    }
     /**
     * @Route("/parcours/apprenant/{id}", name="app_parcours_apprenant_show", methods={"GET"})
     */
    public function show(Parcours $parcour): Response
    {
        return $this->render('parcours_apprenant/show.html.twig', [
            'parcour' => $parcour,
        ]);
    }

    /**
     * @Route("/parcours/apprenant/{id}/edit", name="app_parcours_apprenant_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Parcours $parcour, ParcoursRepository $parcoursRepository): Response
    {
        $form = $this->createForm(ParcoursType::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $parcoursRepository->add($parcour, true);

            return $this->redirectToRoute('app_parcours_apprenant', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parcours_apprenant/edit.html.twig', [
            'parcour' => $parcour,
            'form' => $form,
        ]);
    }

   /**
     * @Route("/parcours/apprenant/{id}", name="app_parcours_apprenant_delete", methods={"POST"})
     */
    public function delete(Request $request, Parcours $parcour, ParcoursRepository $parcoursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parcour->getId(), $request->request->get('_token'))) {
            $parcoursRepository->remove($parcour, true);
        }

        return $this->redirectToRoute('app_parcours_apprenant', [], Response::HTTP_SEE_OTHER);
    }
}
