<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CoachRepository;

final class CoachController extends AbstractController
{
    #[Route('/coach/{slug}', name: 'app_coach')]
    public function index($slug, CoachRepository $coachRepository): Response
    {
        $coach = $coachRepository->findOneBySlug($slug);
        return $this->render('coach/index.html.twig', [
            'coach' => $coach,
        ]);
    }
}
