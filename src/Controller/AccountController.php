<?php

namespace App\Controller;

use App\Form\PasswordUserForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

final class AccountController extends AbstractController
{
    #[Route('/profile', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }

    #[Route('/profile/modifier-mot-de-passe', name: 'app_account_modify_password')]
    public function modifyPassword(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(PasswordUserForm::class, $user, [
            'password_hasher' => $passwordHasher,
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'success',
                "Votre mot de passe est correctement mis à jour"
            );
        }
        return $this->render('account/password.html.twig', [
            'modifyPwdForm' => $form->createView()
        ]);
    }
}