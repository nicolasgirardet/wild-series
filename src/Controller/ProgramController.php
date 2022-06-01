<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EpisodeRepository;
use App\Repository\SeasonRepository;
use App\Entity\Program;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController

{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response

    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [

            'programs' => $programs

        ]);
    }

    #[Route('/{id}', methods: ['GET'], requirements: ['page' => '\d+'], name: 'show')]
    public function show(Program $program): Response

    {
            return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }

    #[Route('/{programId}/season/{seasonId}', methods: ['GET'], requirements: ['page' => '\d+'], name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        $season = $seasonRepository->findBy(['id' => $seasonId]);
        $episode = $episodeRepository->findAll();

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id: ' . $programId . ' found in program\'s table.'
            );
        }

        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id: ' . $seasonId . ' found.'
            );
        }

        return $this->render('program/season_show.html.twig', [

            'program' => $program,
            'season' => $season,
            'episode' => $episode,

        ]);
    }
}
