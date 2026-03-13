<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\FunFactRepository;
use App\Entity\Event;
use App\Form\EventType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class EventController extends AbstractController
{
    #[Route('/event', name: 'event.index')]
    public function index(EventRepository $repository, FunFactRepository $funfactRepository): Response
    {
        date_default_timezone_get();
        $todayDate = date('Y-m-d h:i:s a', time());
        $tomorrowDate = date('Y-m-d h:i:s a', time()+86400);

        $events = $repository->findAll();
        $facts = $funfactRepository->findAll();
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
            'facts'=> $facts,
            'events' => $events,
            'today'=>$todayDate,
            'tomorrow'=>$tomorrowDate,
        ]);
    }

    #[Route('/event/{level}', name: 'event.show')]
    public function show(string $level, EventRepository $repository): Response
    {
        $events = $repository->findBy(['level' => $level]);
        return $this->render('event/show.html.twig', [
            'level' => $level,
            
            'events' => $events,
        ]);
    }

    // #[Route('/event/{level}/{id}/edit', name: 'event.edit')]
    // public function level(Event $event, Request $request,EntityManagerInterface $em): Response
    // {
    //     $modif=$this->createForm(EventType::class, $event);
    //     $modif->handleRequest($request);
    //     if ($modif->isSubmitted() && $modif->isValid()) {
    //        $em->flush();
    //        return $this->render('event.show');
    //     }

    //     return $this->render('event/edit.html.twig',[
    //         'event'=> $event,
    //         'modifForm'=>$modif,
    //     ]);
    // }
}
