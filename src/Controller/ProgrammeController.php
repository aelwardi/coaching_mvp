<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProgrammeRepository;

final class ProgrammeController extends AbstractController
{
    #[Route('/programme/{slug}', name: 'app_programme')]
    public function index($slug, ProgrammeRepository $programmeRepository): Response
    {
        $programme = $programmeRepository->findOneBySlug($slug);
        return $this->render('programme/index.html.twig', [
            'programme' => $programme,
        ]);
    }
}
