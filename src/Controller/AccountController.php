<?php

namespace App\Controller;

use App\Form\PasswordUserTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



final class AccountController extends AbstractController
{
    #[Route('/compte', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    // modification du mot de passe

    #[Route('/compte/modifierpwd', name: 'app_account_modifyPassword')]
    public function password(EntityManagerInterface $interface, Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {

        $user = $this->getUser();
        $Form= $this->createForm(PasswordUserTypeForm::class, $user, [
            'passwordHasher' =>$passwordHasher
            ]
        );
$Form->handleRequest($request);
        
        
if ($Form->isSubmitted() && $Form->isValid()) {

   $interface->flush();
   $this->addFlash(
    'success',
    'Votre mot de passe a bien été modifié'
);
}
else($this->addFlash(
    'error',
    'Votre mot de passe actuel ne corresponds pas'
));

        return $this->render('account/modifyPassword.html.twig', [
            'MyForm' => $Form->createView(),
           
        ]);
    }


}