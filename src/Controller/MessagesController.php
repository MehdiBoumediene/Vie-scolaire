<?php

namespace App\Controller;


use App\Entity\Users;
use App\Entity\Messages;
use App\Form\MessagesType;
use App\Form\ReponseType;
use App\Repository\UsersRepository;
use ContainerRyTOw3N\getResponseService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessagesController extends AbstractController
{
    /**
     * @Route("/messages", name="app_messages")
     */
    public function index(UsersRepository $usersRepository): Response
    {
        return $this->render('messages/index.html.twig', [
            'controller_name' => 'MessagesController',
           
        ]);
    }
     /**
     * @Route("/messages-envoi", name="app_envoi_messages")
     **/
    public function envoiMessages(Request $request): Response
    {
        $message = new Messages;
        $form = $this->createForm(MessagesType::class, $message);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $message->setSender($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            $this->addFlash("message","Le message à été envoyé avec succès.");
            $request->getSession()
            ->getFlashBag()
            ->add('message', 'Le message à été envoyé avec succès.');
            return $this->redirectToRoute('app_messages');
        }
        return $this->render('messages/envoiMessages.html.twig', [
            'controller_name' => 'MessagesController',
            'form'=> $form->createView(),
        ]);
    }
    /**
     * @Route("/messages/{id}", name="app_read_messages")
     */
    public function readMessage(Messages $message,Request $request): Response
    {
    
        $form = $this->createForm(ReponseType::class);
        $form->handleRequest($request);
     
        $em = $this->getDoctrine()->getManager();
   
            if ($form->isSubmitted() && $form->isValid()) {
                $message = new Messages;
 
                $message->setIsRead(true);
                $message->setMessage($form->get('message')->getData());
                $message->setRecipient($form->get('recipient')->getData());
 
                $em->persist($message);
                $em->flush();
                    $form->setMessage($form->getMessage());
                     
                    $form->setRecipient($this->$form->getRecipient());  
 
            }
 
            return $this->renderForm('messages/readMessage.html.twig', [
           
                'form' => $form,
                'message' => $message
            ]);

    
    
    
    }
  /**
     * @Route("/messages-repond", name="app_repond_messages", methods={"GET", "POST"})
     */
    public function answerMessage(Request $request) :Response
    {

        $user = new Users();
        $reponse = new Messages();
       

        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);
      
            if ($form->isSubmitted() && $form->isValid()) {
                    $reponse->setMessage($request); 
            
            
                    $reponse->setRecipient($this->$reponse->getRecipient());  


            }
            return $this->renderForm('messages/readMessage.html.twig', [
            
                'form' => $form,
            ]);

    }
}
