<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\EpisodeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity; 
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\ProgramType;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController

{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response

    {
        $program = $programRepository->findAll();

        return $this->render('program/index.html.twig', [

            'programs' => $program

        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository): Response
    {
        // Create the new Category Object
        $program = new Program();
        // Create the associated form, linked with $category
        $form = $this->createForm(ProgramType::class, $program);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted?
        if($form->isSubmitted() && $form->isValid()) {
            // Deal with the submitted data
            $programRepository->add($program, true);
        }
        // Render the form (best practice)
        return $this->renderForm('program/new.html.twig', 
        [ 'form' => $form, ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(Program $program, SeasonRepository $seasonRepository): Response
    {
        $season = $seasonRepository->findAll();

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $season,
        ]);
    }

    #[Route('/{program}/season/{season}', name: 'season_show', methods: ['GET'])]
    #[Entity('program', options: ['id' => 'program'])]
    #[Entity('season', options: ['id' => 'season'])]
    public function showSeason(Program $program, Season $season, EpisodeRepository $episodeRepository): Response
    {
        $episode = $episodeRepository->findAll();

        return $this->render('program/season_show.html.twig', [

            'program' => $program,
            'season' => $season,
            'episodes' => $episode,
        ]);
    }

    #[Route('/{program}/season/{season}/episode/{episode}', name: 'episode_show', methods: ['GET'])]
    #[Entity('program', options: ['id' => 'program'])]
    #[Entity('season', options: ['id' => 'season'])]
    #[Entity('episode', options: ['id' => 'episode'])]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [

            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }
}
