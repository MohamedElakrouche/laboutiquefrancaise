<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
       $user = new User();
        $form=$this->createForm(RegisterUserTypeForm::class , $user);
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
    // Tu enregistre l'utilisateur en BDD
    $user=$form->getData();
    $entityManager->persist($user);
    $entityManager->flush();
    }
    return $this->render('register/index.html.twig', [
        'registerForm' => $form->createView(),
    ]);
}
}
