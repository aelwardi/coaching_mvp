<?php

namespace App\Controller;

use App\Form\RegisterUserForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

final class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterUserForm::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setRoles(['ROLE_USER']);
            // Save the user to the database
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirect to a success page or login page
            //return $this->redirectToRoute('app_login');
        }
        return $this->render('register/index.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
