<?php

namespace App\Controller;

use App\Form\RegisterUserTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class RegisterController extends AbstractController
{
    #[Route('/inscription ', name: 'app_register')]
    public function index(Request $request): Response
    {
        dd($request);
        $form=$this->createForm(RegisterUserTypeForm::class);

        // SI le formulaire est soumis et valide
        // Tu enregistre l'utilisateur en BDD
        // Tu envoies un message de confirmation

    
        return $this->render('register/index.html.twig', [
            'registerForm' => $form->createView(),
        ]);
    }
}
