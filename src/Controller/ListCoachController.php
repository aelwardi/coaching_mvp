<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CoachRepository;
final class ListCoachController extends AbstractController
{
    #[Route('/coaches', name: 'app_list_coach')]
    public function index(CoachRepository $coachRepository): Response
    {
        $coaches = $coachRepository->findAll();
        return $this->render('list_coach/index.html.twig', [
            'coaches' => $coaches,
        ]);
    }
}
