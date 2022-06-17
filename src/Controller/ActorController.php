<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Actor;
use App\Repository\ProgramRepository;

#[Route('/actor', name: 'actor_')]
class ActorController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ActorRepository $actorRepository): Response
    {
        $actors = $actorRepository->findAll();

        return $this->render('actor/index.html.twig', [
            'actors' => $actors,
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(Actor $actor, ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('actor/show.html.twig', [
            'programs' => $programs,
            'actor' => $actor,
        ]);
    }
}
