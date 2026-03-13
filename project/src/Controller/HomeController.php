<?php

namespace App\Controller;

use App\Form\EventType;
use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {   
        $event=new Event();

        date_default_timezone_get();
        $todayDate = date('Y-m-d h:i:s a', time());
        $tomorrowDate = date('Y-m-d h:i:s a', time()+86400);

        $form=$this->createForm(EventType::class,$event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($event);
            $em->flush();
            $this->addFlash('sucess', 'Le cours a été ajouté');
            // return $this->redirectToRoute('event.index');
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'eventForm'=>$form,
            
        ]);
    }
}
