<?php

namespace App\Controller;

use App\Repository\CalendrierRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function calendrier(CalendrierRepository $calendrier,UsersRepository $users): Response
    {
        $events = $calendrier->findAll();
        $rdvs = [];
        $rdvs2 = [];
        foreach ($events as $event){

            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i'),
                'end' => $event->getEnd()->format('Y-m-d H:i'),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
                'title' => $event->getTitre(),
                'description' => $event->getDescription(),
                'classe' => $event->getClasse()->getNom(),
                'bloc' => $event->getBloc()->getNom(),
                'module' => $event->getModule()->getNom(),
                'intervenant' => $event->getIntervenant()->getNom(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
                'type' => $event->getType(),


            ];


            
            $classe= $event->getClasse();


            $data = json_encode($rdvs);
     
            
        }

        $etudiants = $users->findByClasse($classe);
        return $this->render('main/gestion_calendrier.html.twig', [
            'etudiants_calendar' => $etudiants,
            'data' => compact('data'),
        ]
    
    );
    }


    
     /**
     * @Route("/calendrier_absences", name="app_gestion_calendrier_absences", methods={"GET", "POST"})
     */
    public function calendrierAbsences( EntityManagerInterface $em, Request $request): Response
    {

        $etat = $request->query->get('etat');
        $user = $request->query->get('user');
        $qb = $em->createQueryBuilder();
        $q = $qb->update('App:Users', 'u')

            ->set('u.etat','?1')
     

            ->where('u.id = ?2')

            ->setParameter(1,$etat)
            ->setParameter(2,$user)
         
            ->getQuery();
        $p = $q->execute();

  
        $response = new JsonResponse();
        $response->setContent(json_encode($etat));
        $response->headers->set('Content-Type','application/json');

        return $response->setData(array('etat'=>$etat,'user'=>$user));

    
  
    }

    /**
     * @Route("/calendrier_etudiant", name="app_calendrier_etudiant")
     */
    public function calendrierEtudiant(CalendrierRepository $calendrier): Response
    {
        $events = $calendrier->findAll();
        $rdvs = [];
        foreach ($events as $event){

            foreach ($event->getClasse() as $classe){
                $rdvs[] = [
                'classe' => $classe->getNom(),
            ];
            }

            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i'),
                'end' => $event->getEnd()->format('Y-m-d H:i'),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
                'title' => $event->getTitre(),
                'description' => $event->getDescription(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
                'type' => $event->getType(),


            ];

            $data = json_encode($rdvs);
        }
        return $this->render('main/calendrier_etudiant.html.twig',compact('data'));
    }

     /**
     * @Route("/calendrier_intervenant", name="app_calendrier_intervenant")
     */
    public function calendrierIntervenant(CalendrierRepository $calendrier): Response
    {
        $events = $calendrier->findAll();
        $rdvs = [];
        foreach ($events as $event){

            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i'),
                'end' => $event->getEnd()->format('Y-m-d H:i'),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
                'title' => $event->getTitre(),
                'description' => $event->getDescription(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
                'type' => $event->getType(),


            ];

            $data = json_encode($rdvs);
        }
        return $this->render('main/calendrier_intervenant.html.twig',compact('data'));
    }
}
